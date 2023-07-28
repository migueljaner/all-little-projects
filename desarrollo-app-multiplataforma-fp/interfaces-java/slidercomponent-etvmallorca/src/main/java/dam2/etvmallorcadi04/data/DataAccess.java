package dam2.etvmallorcadi04.data;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;
import dam2.etvmallorcadi04.dto.Allotjament;
import dam2.etvmallorcadi04.dto.Comentari;
import dam2.etvmallorcadi04.dto.Municipi;
import dam2.etvmallorcadi04.dto.Servei;
import dam2.etvmallorcadi04.dto.Usuari;

public class DataAccess {

    // Establecer conexion con la base de datos a traves del fichero creado application.properties
    private Connection getConnection() {
        Connection connection = null;
        Properties properties = new Properties();
        try {
            properties.load(DataAccess.class.getClassLoader().getResourceAsStream("properties/application.properties"));
            connection = DriverManager.getConnection(properties.getProperty("url"), properties);
            //connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/etvmallorca", "root", "...");
        } catch (Exception e) {
            e.printStackTrace();
        }
        return connection;
    }

    // Devuelve un ArrayList de todos los municipios (su id y su nombre)
    public ArrayList<Municipi> getMunicipis() {
        ArrayList<Municipi> municipis = new ArrayList<>();
        String sql = "SELECT * FROM municipi";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Municipi municipi = new Municipi();
                municipi.setId(resultSet.getInt("id"));
                municipi.setNom(resultSet.getString("nom"));
                municipis.add(municipi);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return municipis;
    }

    // Metodo para extraer el id del Municipi al que pertenece el newAllotjament
    public int extractIdMunicipi(String municipi) {
        List<Municipi> municipis = getMunicipis();
        int idMunicipi = 0;
        for (Municipi m : municipis) {
            if (municipi.equals(m.getNom())) {
                idMunicipi = m.getId();
                break;
            }
        }
        return idMunicipi;
    }

    // Devuelve la contrasenya de un usuario pasandole por parametro el email de dicho usuario
    public String findUserPassword(String email) {
        String passwordInDb = null;
        String sql = "SELECT password FROM usuari WHERE email = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
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

    // Devuelve el id de un usuario pasandole por parametro el email de dicho usuario
    public int getUserId(String email) {
        int userId = 0;
        String sql = "SELECT id FROM usuari WHERE email = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
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

    // Devuelve un unico objeto especifico de Usuari filtrandolo por su email
    public Usuari getUser(String email) {
        Usuari user = null;
        String sql = "SELECT * FROM usuari WHERE email = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setString(1, email);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                if (user == null) {
                    user = new Usuari();
                }

                user.setId(resultSet.getInt("id"));
                user.setNom(resultSet.getString("nom"));
                user.setLlinatges(resultSet.getString("llinatges"));
                user.setEmail(resultSet.getString("email"));
                user.setPassword(resultSet.getString("password"));
                user.setAdmin(resultSet.getBoolean("isAdmin"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return user;
    }

    // Devuelve un unico objeto especifico de Usuari filtrandolo por su id
    public Usuari getUser(int id) {
        Usuari user = null;
        String sql = "SELECT * FROM usuari WHERE id = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, id);
            ResultSet resultSet = selectStatement.executeQuery();
            user = new Usuari();
            while (resultSet.next()) {
                user.setId(resultSet.getInt("id"));
                user.setNom(resultSet.getString("nom"));
                user.setLlinatges(resultSet.getString("llinatges"));
                user.setEmail(resultSet.getString("email"));
                user.setPassword(resultSet.getString("password"));
                user.setAdmin(resultSet.getBoolean("isAdmin"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return user;
    }

    // Devuelve un ArrayList de todos los allotjaments que posee un usuario especifico
    public ArrayList<Allotjament> getAllotjaments(int userId) {
        ArrayList<Allotjament> allotjaments = new ArrayList<>();
        String sql = "SELECT allotjament.id AS id_allotjament, allotjament.nom AS nom_allotjament, descripcio, adresa,"
                + " municipi.nom AS nom_municipi, num_persones, preu_per_nit"
                + " FROM allotjament JOIN municipi ON allotjament.id_municipi=municipi.id"
                + " WHERE id_propietari=?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, userId);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Allotjament allotjament = new Allotjament();
                allotjament.setId(resultSet.getInt("id_allotjament"));
                allotjament.setNom(resultSet.getString("nom_allotjament"));
                allotjament.setDescripcio(resultSet.getString("descripcio"));
                allotjament.setAdresa(resultSet.getString("adresa"));
                allotjament.setMunicipi(resultSet.getString("nom_municipi"));
                allotjament.setNumPersones(resultSet.getInt("num_persones"));
                allotjament.setPreuPerNit(resultSet.getFloat("preu_per_nit"));

                allotjaments.add(allotjament);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allotjaments;
    }

    // Devuelve un unico objeto especifico de Allotjament filtrandolo por su id
    public Allotjament getAllotjament(int id) {
        Allotjament allotjament = new Allotjament();
        String sql = "SELECT allotjament.id AS id_allotjament, allotjament.nom AS nom_allotjament, descripcio, adresa,"
                + " municipi.nom AS nom_municipi, num_persones, preu_per_nit"
                + " FROM allotjament JOIN municipi ON allotjament.id_municipi=municipi.id"
                + " WHERE allotjament.id=?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, id);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                allotjament.setId(resultSet.getInt("id_allotjament"));
                allotjament.setNom(resultSet.getString("nom_allotjament"));
                allotjament.setDescripcio(resultSet.getString("descripcio"));
                allotjament.setAdresa(resultSet.getString("adresa"));
                allotjament.setMunicipi(resultSet.getString("nom_municipi"));
                allotjament.setNumPersones(resultSet.getInt("num_persones"));
                allotjament.setPreuPerNit(resultSet.getFloat("preu_per_nit"));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return allotjament;
    }

    // Devuelve el numero de fila del alojamiento pasado por parametro que ha sido actualizado en la BD
    public int updateAllojtament(Allotjament allotjament) {
        int result = 0;
        String sql = "UPDATE allotjament SET nom = ?, descripcio = ?,"
                + " num_persones = ?, adresa = ?, id_municipi = ?,"
                + " destacat = ?, preu_per_nit = ?"
                + " WHERE id = ?";
        try (Connection connection = getConnection(); PreparedStatement updateStatement = connection.prepareStatement(sql);) {
            updateStatement.setString(1, allotjament.getNom());
            updateStatement.setString(2, allotjament.getDescripcio());
            updateStatement.setInt(3, allotjament.getNumPersones());
            updateStatement.setString(4, allotjament.getAdresa());
            updateStatement.setInt(5, allotjament.getIdMunicipi());
            updateStatement.setBoolean(6, false);
            updateStatement.setFloat(7, allotjament.getPreuPerNit());
            updateStatement.setInt(8, allotjament.getId());
            result = updateStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    // Devuelve el numero de fila donde ha sido insertado un nuevo allotjament a la BD
    public int insertAllotjament(Allotjament allotjament) {
        int result = 0;
        String sql = "INSERT INTO allotjament (nom, descripcio, num_persones, adresa, "
                + "id_municipi, id_propietari, destacat, preu_per_nit) "
                + "VALUES (?,?,?,?,?,?,?,?)";
        try (Connection connection = getConnection(); PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setString(1, allotjament.getNom());
            insertStatement.setString(2, allotjament.getDescripcio());
            insertStatement.setInt(3, allotjament.getNumPersones());
            insertStatement.setString(4, allotjament.getAdresa());
            insertStatement.setInt(5, allotjament.getIdMunicipi());
            insertStatement.setInt(6, allotjament.getIdPropietari());
            insertStatement.setBoolean(7, false);
            insertStatement.setFloat(8, allotjament.getPreuPerNit());

            result = insertStatement.executeUpdate();

            if (result > 0) {
                result = getIdLastInsertedAllotjament();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    // Devuelve la cantidad/ultimo id de alojamientos
    private int getIdLastInsertedAllotjament() {
        int idAllotjament = 0;
        String sql = "SELECT MAX(id) AS last_id_allotjament FROM allotjament";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {

            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                idAllotjament = resultSet.getInt("last_id_allotjament");
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return idAllotjament;
    }

    // Devuelve un ArrayList de serveis que tiene un alojamiento en especifico
    public ArrayList<Servei> getServeisAllotjament(int idAllotjament) {
        ArrayList<Servei> serveis = new ArrayList<>();
        String sql = "SELECT servei.id, servei.descripcio FROM servei JOIN servei_allotjament"
                + " ON servei.id=servei_allotjament.id_servei"
                + " WHERE servei_allotjament.id_allotjament=?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, idAllotjament);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Servei servei = new Servei();
                servei.setId(resultSet.getInt("id"));
                servei.setDescripcio(resultSet.getString("descripcio"));
                serveis.add(servei);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return serveis;
    }

    // Devuelve [int] si un nuevo servicio se ha anyadido a un alojamiento especifico
    public int insertServei(int idServei, int idAllotjament) {
        int result = 0;
        String sql = "INSERT INTO servei_allotjament (id_servei, id_allotjament) VALUES (?,?)";
        try (Connection connection = getConnection(); PreparedStatement insertStatement = connection.prepareStatement(sql);) {
            insertStatement.setInt(1, idServei);
            insertStatement.setInt(2, idAllotjament);
            result = insertStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    // Devuelve [int] si los servicios de un alojamiento en especifico han sido actualizados en la BD
    public int updateServeisAllotjament(int idAllotjament, int[] serveis) {
        // Brute force
        int result = 0;
        String sql = "DELETE FROM servei_allotjament WHERE id_allotjament = ?";
        try (Connection connection = getConnection(); PreparedStatement deleteStatement = connection.prepareStatement(sql);) {
            deleteStatement.setInt(1, idAllotjament);
            result = deleteStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }

        for (int i = 0; i < serveis.length; i++) {
            if (serveis[i] == 1) {
                insertServei(i + 1, idAllotjament);
            }
        }

        return result;
    }

    // Devuelve un ArrayList de comentarios de un alojamiento en especifico
    public ArrayList<Comentari> getComentaris(int idAllotjament) {
        ArrayList<Comentari> comentaris = new ArrayList<>();
        String sql = "SELECT comentari.id, comentari.text, comentari.dataihora,"
                + " comentari.id_usuari, comentari.id_allotjament, comentari.id_comentari_pare"
                + " FROM comentari WHERE id_allotjament = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, idAllotjament);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                Comentari comentari = new Comentari();
                comentari.setId(resultSet.getInt("id"));
                comentari.setText(resultSet.getString("text"));
                comentari.setDataihora(resultSet.getString("dataihora"));
                comentari.setIdUsuari(resultSet.getInt("id_usuari"));
                comentari.setIdAllotjament(resultSet.getInt("id_allotjament"));
                comentari.setIdComentariPare(resultSet.getInt("id_comentari_pare"));
                comentaris.add(comentari);
                /*
                DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
                LocalDateTime dataihora = LocalDateTime.parse(resultSet.getString("dataihora"), dtf);
                System.out.println(getUser(resultSet.getInt("id_usuari")).getNom()
                        + " said:\n " + resultSet.getString("text") + "\nOn "
                        + dataihora.toString());
                 */
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return comentaris;
    }

    // Devuelve un Float con la valoracion media de un alojamiento especifico
    public float getValoracioAllotjamentAvg(int idAllotjament) {
        float valoracioAvg = 0.0f;
        String sql = "SELECT AVG(num_estrelles) AS avg_valoracio FROM valoracio WHERE id_allotjament = ?";
        try (Connection connection = getConnection(); PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, idAllotjament);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                valoracioAvg = resultSet.getFloat("avg_valoracio");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }

        return valoracioAvg;
    }

    // Devuelve [int] al insertar un comentario por un usuario en un alojamiento especifico en la BD
    public int insertComentari(String text, int userId, int idAllotjament, int idComentariPare) {
        int result = 0;
        String sql = "INSERT INTO comentari (text, dataihora, id_usuari, id_allotjament"
                + ", id_comentari_pare) VALUES (?,?,?,?,?)";
        try (Connection connection = getConnection(); PreparedStatement insertStatement = connection.prepareStatement(sql);) {
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

    // Metodo para actualizar la informacion de un usuario
    public int updateUser(Usuari user) {
        int result = 0;
        String sql = "UPDATE usuari SET nom = ?, llinatges = ?, password = ? WHERE email = ?";
        try (Connection connection = getConnection(); PreparedStatement updateStatement = connection.prepareStatement(sql);) {
            updateStatement.setString(1, user.getNom());
            updateStatement.setString(2, user.getLlinatges());
            updateStatement.setString(3, user.getPassword());
            updateStatement.setString(4, user.getEmail());
            result = updateStatement.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }
    public ArrayList<byte[]> getImagesAllotjament(int id) {
        ArrayList<byte[]> images = new ArrayList<>();
        String sql = "SELECT imatge FROM imatge JOIN imatge_allotjament"
                + " ON imatge.id= imatge_allotjament.id_imatge"
                + " WHERE imatge_allotjament.id_allotjament=?";
        try ( Connection connection = getConnection();  PreparedStatement selectStatement = connection.prepareStatement(sql);) {
            selectStatement.setInt(1, id);
            ResultSet resultSet = selectStatement.executeQuery();
            while (resultSet.next()) {
                byte[] image = resultSet.getBytes(1);
                
                images.add(image);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return images;
    }
}
