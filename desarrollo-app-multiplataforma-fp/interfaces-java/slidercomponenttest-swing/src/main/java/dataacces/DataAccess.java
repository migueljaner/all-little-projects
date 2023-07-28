package dataacces;

import java.awt.Image;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Properties;
import javax.swing.ImageIcon;


/**
 *
 * @author Miguel
 */
public class DataAccess {

    private Connection getConnection() {
        Connection connection = null;
        Properties properties = new Properties();
        try {
//            properties.load(DataAccess.class.getClassLoader().getResourceAsStream("properties/application.properties"));
//            connection = DriverManager.getConnection(properties.getProperty("url"), properties);
            connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/etvmallorca", "root", "");
        } catch (Exception e) {
            e.printStackTrace();
        }
        return connection;
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
    public static ImageIcon byteArrayToImage(byte [] image){
        ImageIcon icon = new ImageIcon(image);
        return icon;
    }
    
}
