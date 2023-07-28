package dataacces;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import dto.*;
import java.beans.Statement;
import java.sql.Savepoint;

/**
 *
 * @author Miguel
 */
public class DataAccess {

    private Connection getConnection() {
        Connection connection = null;
        //Properties properties = new Properties();
        try {
            //properties.load(DataAccess.class.getClassLoader().getResourceAsStream("properties/application.properties"));
            //connection = DriverManager.getConnection(properties.getProperty("url"), properties);
            connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/gestionreseñas", "root", "");
        } catch (Exception e) {
            e.printStackTrace();
        }
        return connection;
    }

    public ArrayList<Establecimiento> getEstablecimientos() {
        ArrayList<Establecimiento> establecimientos = new ArrayList<>();
        String sql = "SELECT * FROM establecimiento";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Establecimiento estab = new Establecimiento();
                estab.setId(resultSet.getInt("id"));
                estab.setNombre(resultSet.getString("nombre"));
                estab.setDescripcion(resultSet.getString("descripcion"));
                estab.setCreated_at(resultSet.getDate("created_at"));
                estab.setUpdate_at(resultSet.getDate("update_at"));
                establecimientos.add(estab);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return establecimientos;
    }

    public String findUserPassword(String email) {
        String passwordInDb = null;
        String sql = "SELECT password FROM usuario WHERE email = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setString(1, email);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                passwordInDb = resultSet.getString("password");
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return passwordInDb;
    }

    public int getUserId(String email) {
        int userId = 0;
        String sql = "SELECT id FROM usuario WHERE email = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setString(1, email);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                userId = resultSet.getInt("id");
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return userId;
    }

    public Usuario getUser(String email) {
        Usuario user = null;
        String sql = "SELECT * FROM usuario WHERE email = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setString(1, email);
            ResultSet resultSet = selectStatement.executeQuery();
            user = new Usuario();
            while (resultSet.next()) {
                user.setId(resultSet.getInt("id"));
                user.setEmail(resultSet.getString("email"));
                user.setPassword(resultSet.getString("password"));

            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return user;
    }

    public int insertUsuario(Usuario usuario) {
        int result = 0;
        String sql = "INSERT INTO usuario (email, password, created_at, update_at) "
                + "VALUES (?,?,sysdate(),sysdate())";
        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setString(1, usuario.getEmail());
            insertStatement.setString(2, usuario.getPassword());

            result = insertStatement.executeUpdate();

            if (result > 0) {
                result = getIdLastInsertedUsuario();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    private int getIdLastInsertedUsuario() {
        int idUsuario = 0;
        String sql = "SELECT MAX(id) AS last_id_usuario FROM usuario";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {

            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                idUsuario = resultSet.getInt("last_id_usuario");
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return idUsuario;
    }

    public ContactInfo getInfoContact(Establecimiento establecimiento) {
        ContactInfo info = null;
        String sql = "SELECT * FROM info_contacto WHERE id_establecimiento = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, establecimiento.getId());
            ResultSet resultSet = selectStatement.executeQuery();
            info = new ContactInfo();
            while (resultSet.next()) {
                info.setId(resultSet.getInt("id_establecimiento"));
                info.setDireccion(resultSet.getString("direccion"));
                info.setPais(resultSet.getString("pais"));
                info.setEstado(resultSet.getBoolean("estado"));
                info.setCreated_at(resultSet.getDate("created_at"));
                info.setUpdate_at(resultSet.getDate("update_at"));

            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return info;
    }

    public float getValoracioEstablecimientoAvg(int idEstablecimiento) {
        float valoracioAvg = 0.0f;
        String sql = "SELECT AVG(valoracion) AS avg_valoracio FROM reseña WHERE id_establecimiento = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, idEstablecimiento);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                valoracioAvg = resultSet.getFloat("avg_valoracio");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return valoracioAvg;
    }

    public int updateReseñaUpdateAt(Reseña reseña) {
        int result = 0;
        String sql = "UPDATE reseña SET update_at = sysdate() WHERE id = ?";
        try ( Connection connection = getConnection();  PreparedStatement updateStatement = connection.prepareStatement(sql);) {
            updateStatement.setInt(1, reseña.getId());
            result = updateStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return result;
    }

    public int deleteUserReviews(Usuario usuario) {
        int result = 0;

        String sql = "DELETE FROM reseña WHERE id_usuario = ?;";

        try ( Connection connection = getConnection();  PreparedStatement transactionStatement = connection.prepareStatement(sql);) {
            connection.setAutoCommit(false);

            Savepoint savePointReseña = connection.setSavepoint("savePointReseña");

            transactionStatement.setInt(1, usuario.getId());

            result = transactionStatement.executeUpdate();
            if (result < 0) {
                connection.rollback(savePointReseña);
            } else {
                sql = "DELETE FROM usuario WHERE id = ?";
                try ( PreparedStatement transactionStatement2 = connection.prepareStatement(sql)) {
                    Savepoint savePointReseña2 = connection.setSavepoint("savePointReseña2");

                    transactionStatement2.setInt(1, usuario.getId());

                    result = transactionStatement2.executeUpdate();
                    if (result > 0) {
                        connection.commit();
                    } else {
                        connection.rollback(savePointReseña2);
                    }
                } catch (SQLException e) {
                    e.printStackTrace();
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return result;
    }

    public ArrayList<Reseña> getEstabReseñas(Establecimiento estab) {

        ArrayList<Reseña> reseñas = new ArrayList<>();
        String sql = "SELECT * FROM reseña WHERE id_establecimiento = ? ";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, estab.getId());
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Reseña reseña = new Reseña();
                reseña.setId(resultSet.getInt("id"));
                reseña.setId_usuario(resultSet.getInt("id_usuario"));
                reseña.setId_establecimiento(resultSet.getInt("id_establecimiento"));
                reseña.setDescripcion(resultSet.getString("descripcion"));
                reseña.setValoracion(resultSet.getInt("valoracion"));
                reseña.setCreated_at(resultSet.getDate("created_at"));
                reseña.setUpadate_at(resultSet.getDate("update_at"));
                reseñas.add(reseña);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return reseñas;

    }

    public int insertReseña(Reseña reseña) {
        int result = 0;
        String sql = "INSERT INTO reseña (id_usuario, id_establecimiento, descripcion, valoracion, created_at, update_at) "
                + "VALUES (?,?,?,?,sysdate(),sysdate())";
        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setInt(1, reseña.getId_usuario());
            insertStatement.setInt(2, reseña.getId_establecimiento());
            insertStatement.setString(3, reseña.getDescripcion());
            insertStatement.setInt(4, reseña.getValoracion());
            result = insertStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }
    public int updateUser(Usuario usuario) {
        int result = 0;
        String sql = "UPDATE usuario SET email = ?, password = ?, update_at = sysdate()"
                + "WHERE id = ?";
        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setString(1, usuario.getEmail());
            insertStatement.setString(2, usuario.getPassword());
            insertStatement.setInt(3, usuario.getId());
            result = insertStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }
//    public ArrayList<Allotjament> getAllotjaments(int userId) {
//        ArrayList<Allotjament> allotjaments = new ArrayList<>();
//        String sql = "SELECT allotjament.id AS id_allotjament, allotjament.nom AS nom_allotjament, descripcio, adresa,"
//                + " municipi.nom AS nom_municipi, municipi.id AS id_municipi ,num_persones, preu_per_nit"
//                + " FROM allotjament JOIN municipi ON allotjament.id_municipi=municipi.id"
//                + " WHERE id_propietari=?";
//        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
//            selectStatement.setInt(1, userId);
//            ResultSet resultSet = selectStatement.executeQuery();
//            while (resultSet.next()) {
//                Allotjament allotjament = new Allotjament();
//                allotjament.setId(resultSet.getInt("id_allotjament"));
//                allotjament.setNom(resultSet.getString("nom_allotjament"));
//                allotjament.setDescripcio(resultSet.getString("descripcio"));
//                allotjament.setAdresa(resultSet.getString("adresa"));
//                allotjament.setMunicipi(resultSet.getString("nom_municipi"));
//                allotjament.setId_Municipi(resultSet.getInt("id_municipi"));
//                allotjament.setNum_persones(resultSet.getInt("num_persones"));
//                allotjament.setPreu_per_nit(resultSet.getFloat("preu_per_nit"));
//
//                allotjaments.add(allotjament);
//            }
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return allotjaments;
//    }
//
//    public Allotjament getAllotjament(int id) {
//        Allotjament allotjament = new Allotjament();
//        String sql = "SELECT allotjament.id AS id_allotjament, allotjament.nom AS nom_allotjament, descripcio, adresa,"
//                + " municipi.nom AS nom_municipi, num_persones, preu_per_nit"
//                + " FROM allotjament JOIN municipi ON allotjament.id_municipi=municipi.id"
//                + " WHERE allotjament.id=?";
//        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
//            selectStatement.setInt(1, id);
//            ResultSet resultSet = selectStatement.executeQuery();
//            while (resultSet.next()) {
//                allotjament.setId(resultSet.getInt("id_allotjament"));
//                allotjament.setNom(resultSet.getString("nom_allotjament"));
//                allotjament.setDescripcio(resultSet.getString("descripcio"));
//                allotjament.setAdresa(resultSet.getString("adresa"));
//                allotjament.setMunicipi(resultSet.getString("nom_municipi"));
//                allotjament.setNum_persones(resultSet.getInt("num_persones"));
//                allotjament.setPreu_per_nit(resultSet.getFloat("preu_per_nit"));
//            }
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return allotjament;
//    }
//
//    public int updateAllojtament(Allotjament allotjament) {
//        int result = 0;
//        String sql = "UPDATE allotjament SET nom = ?, descripcio = ?,"
//                + " num_persones = ?, adresa = ?, id_municipi = ?,"
//                + " destacat = ?, preu_per_nit = ?"
//                + " WHERE id = ?";
//        try ( Connection connection = getConnection();  PreparedStatement updateStatement = connection.prepareStatement(sql);) {
//            updateStatement.setString(1, allotjament.getNom());
//            updateStatement.setString(2, allotjament.getDescripcio());
//            updateStatement.setInt(3, allotjament.getNum_persones());
//            updateStatement.setString(4, allotjament.getAdresa());
//            updateStatement.setInt(5, allotjament.getId_municipi());
//            updateStatement.setBoolean(6, false);
//            updateStatement.setFloat(7, allotjament.getPreu_per_nit());
//            updateStatement.setInt(8, allotjament.getId());
//            result = updateStatement.executeUpdate();
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return result;
//    }
//
//    public int insertAllotjament(Allotjament allotjament) {
//        int result = 0;
//        String sql = "INSERT INTO allotjament (nom, descripcio, num_persones, adresa, "
//                + "id_municipi, id_propietari, destacat, preu_per_nit) "
//                + "VALUES (?,?,?,?,?,?,?,?)";
//        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
//            insertStatement.setString(1, allotjament.getNom());
//            insertStatement.setString(2, allotjament.getDescripcio());
//            insertStatement.setInt(3, allotjament.getNum_persones());
//            insertStatement.setString(4, allotjament.getAdresa());
//            insertStatement.setInt(5, allotjament.getId_municipi());
//            insertStatement.setInt(6, allotjament.getId_propietari());
//            insertStatement.setBoolean(7, false);
//            insertStatement.setFloat(8, allotjament.getPreu_per_nit());
//
//            result = insertStatement.executeUpdate();
//
//            if (result > 0) {
//                result = getIdLastInsertedAllotjament();
//            }
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return result;
//    }
//
//    private int getIdLastInsertedAllotjament() {
//        int idAllotjament = 0;
//        String sql = "SELECT MAX(id) AS last_id_allotjament FROM allotjament";
//        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
//
//            ResultSet resultSet = selectStatement.executeQuery();
//            while (resultSet.next()) {
//                idAllotjament = resultSet.getInt("last_id_allotjament");
//            }
//
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return idAllotjament;
//    }
//
//    public ArrayList<Servei> getServeisAllotjament(int idAllotjament) {
//        ArrayList<Servei> serveis = new ArrayList<>();
//        String sql = "SELECT servei.id, servei.descripcio FROM servei JOIN servei_allotjament"
//                + " ON servei.id=servei_allotjament.id_servei"
//                + " WHERE servei_allotjament.id_allotjament=?";
//        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
//            selectStatement.setInt(1, idAllotjament);
//            ResultSet resultSet = selectStatement.executeQuery();
//            while (resultSet.next()) {
//                Servei servei = new Servei();
//                servei.setId(resultSet.getInt("id"));
//                servei.setDescripcio(resultSet.getString("descripcio"));
//                serveis.add(servei);
//            }
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return serveis;
//    }
//
//    public int insertServei(int idServei, int idAllotjament) {
//        int result = 0;
//        String sql = "INSERT INTO servei_allotjament (id_servei, id_allotjament) VALUES (?,?)";
//        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
//            insertStatement.setInt(1, idServei);
//            insertStatement.setInt(2, idAllotjament);
//            result = insertStatement.executeUpdate();
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//        return result;
//    }
//
//    public int updateServeisAllotjament(int idAllotjament, int[] serveis) {
//        // Brute force
//        int result = 0;
//        String sql = "DELETE FROM servei_allotjament WHERE id_allotjament = ?";
//        try ( Connection connection = getConnection();  PreparedStatement deleteStatement = connection.prepareStatement(sql);) {
//            deleteStatement.setInt(1, idAllotjament);
//            result = deleteStatement.executeUpdate();
//        } catch (SQLException e) {U
//            e.printStackTrace();
//        }
//
//        for (int i = 0; i < serveis.length; i++) {
//            if (serveis[i] == 1) {
//                insertServei(i + 1, idAllotjament);
//            }
//        }
//
//        return result;
//    }
//
//    public float getValoracioAllotjamentAvg(int idAllotjament) {
//        float valoracioAvg = 0.0f;
//        String sql = "SELECT AVG(num_estrelles) AS avg_valoracio FROM valoracio WHERE id_allotjament = ?";
//        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
//            selectStatement.setInt(1, idAllotjament);
//            ResultSet resultSet = selectStatement.executeQuery();
//            while (resultSet.next()) {
//                valoracioAvg = resultSet.getFloat("avg_valoracio");
//            }
//        } catch (SQLException e) {
//            e.printStackTrace();
//        }
//
//        return valoracioAvg;
//    }
    /*
    public ArrayList<Comentari> getComentaris(int idAllotjament) {
        ArrayList<Comentari> comentaris = new ArrayList<>();
        String sql = "SELECT comentari.id, comentari.text, comentari.dataihora,"
                + " usuari.nom, usuari.llinatges, comentari.id_allotjament, comentari.id_comentari_pare FROM"
                + " comentari JOIN usuari ON comentari.id_usuari=usuari.id"
                + " WHERE id_allotjament = ?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, idAllotjament);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Comentari comentari = new Comentari();
                comentari.setId(resultSet.getInt("id"));
                comentari.setText(resultSet.getString("text"));
                //DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
                //LocalDateTime dataihora = LocalDateTime.parse(resultSet.getString("dataihora"), dtf);
                comentari.setDataihora(resultSet.getString("dataihora"));

                comentari.setUsuari(resultSet.getString("nom") + " " + resultSet.getString("llinatges"));
                //String comentari = usuari + " said:\n " + text + "\nOn " + dataihora.toString();
                comentari.setIdAllotjament(resultSet.getInt("id_allotjament"));
                comentari.setIdComentariPare(resultSet.getInt("id_comentari_pare"));
                comentaris.add(comentari);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return comentaris;
    }

    

    public int insertComentari(String text, int userId, int idAllotjament, int idComentariPare) {
        int result = 0;
        String sql = "INSERT INTO comentari (text, dataihora, id_usuari, id_allotjament"
                + ", id_comentari_pare) VALUES (?,?,?,?,?)";
        try ( Connection connection = getConnection();  PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setString(1, text);
            insertStatement.setString(2, LocalDateTime.now().toString());
            insertStatement.setInt(3, userId);
            insertStatement.setInt(4, idAllotjament);
            insertStatement.setInt(5, idComentariPare);
            result = insertStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }
     */
}
