package dam2.di07alojamientos;

import com.google.gson.Gson;
import com.google.gson.stream.JsonReader;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import javax.imageio.ImageIO;

public class DataAccess {

    private boolean allotjamentsLoaded = false;
    ArrayList<Allotjament> allotjaments = new ArrayList<>();

    // Metodo para cargar los allotjaments del archivo JSON al ArrayList allotjaments
    private void loadAllotjaments() {
        Gson gson = new Gson();
        try {
            String JSON_DATA_FILE = Constants.JSON_DATA_FILE;
            JsonReader jr = new JsonReader(new FileReader(JSON_DATA_FILE));

            // Introducir las obras del archivo JSON al ArrayList allotjaments
            allotjaments = gson.fromJson(jr, Constants.LIST_OF_ALLOTJAMENT_TYPE);
            jr.close();
            allotjamentsLoaded = true;
        } catch (FileNotFoundException e) {
            System.err.println("FileNotFoundException Error: " + e.getMessage());
        } catch (IOException e) {
            System.err.println("IOException Error: " + e.getMessage());
        }
    }

    // Metodo para obtener los allotjaments
    public ArrayList<Allotjament> getAllotjaments() {
        if (!allotjamentsLoaded) {
            loadAllotjaments();
        }
        return allotjaments;
    }

    // Metodo para insertar un nuevo allotjament
    public void insertAllotjament(Allotjament newAllotjament, String newProfileImageFilePath) throws Exception {
        if (allotjaments != null) {
            if (!allotjaments.contains(newAllotjament)) {
                allotjaments.add(newAllotjament);
                File newProfileImageFile = new File(Constants.IMAGES_FOLDER + newAllotjament.getName() + "." + Constants.DEFAULT_PHOTO_TYPE);
                if (!newProfileImageFile.exists()) {
                    try {
                        BufferedImage profileBufferedImage;
                        if (!Constants.NO_IMAGE.equals(newProfileImageFilePath)) {
                            profileBufferedImage = ImageIO.read(new File(newProfileImageFilePath));
                        } else {
                            profileBufferedImage = ImageIO.read(getClass().getResource("/noImage.png"));
                        }
                        BufferedImage resizedBufferedImage = Utilities.resizeImageIcon(profileBufferedImage,
                                Constants.DEFAULT_IMAGE_WIDTH, Constants.DEFAULT_IMAGE_HEIGHT);
                        ImageIO.write(resizedBufferedImage, Constants.DEFAULT_PHOTO_TYPE, newProfileImageFile);
                        newAllotjament.setImage(newProfileImageFile.getName());
                        saveAllotjaments();
                    } catch (IOException ioe) {
                        newAllotjament.setImage(Constants.NO_IMAGE);
                        ioe.printStackTrace();
                    }
                }
            } else {
                throw new Exception("Allotjament " + newAllotjament.getName() + " already exists in database");
            }
        } else {
            ArrayList<Allotjament> alojamientos = new ArrayList<>();
            alojamientos.add(newAllotjament);
            allotjaments = alojamientos;
            File newProfileImageFile = new File(Constants.IMAGES_FOLDER + newAllotjament.getName() + "." + Constants.DEFAULT_PHOTO_TYPE);
            if (!newProfileImageFile.exists()) {
                try {
                    BufferedImage profileBufferedImage;
                    if (!Constants.NO_IMAGE.equals(newProfileImageFilePath)) {
                        profileBufferedImage = ImageIO.read(new File(newProfileImageFilePath));
                    } else {
                        profileBufferedImage = ImageIO.read(getClass().getResource("/noImage.png"));
                    }
                    BufferedImage resizedBufferedImage = Utilities.resizeImageIcon(profileBufferedImage,
                            Constants.DEFAULT_IMAGE_WIDTH, Constants.DEFAULT_IMAGE_HEIGHT);
                    ImageIO.write(resizedBufferedImage, Constants.DEFAULT_PHOTO_TYPE, newProfileImageFile);
                    newAllotjament.setImage(newProfileImageFile.getName());
                    saveAllotjaments();
                } catch (IOException ioe) {
                    newAllotjament.setImage(Constants.NO_IMAGE);
                    ioe.printStackTrace();
                }
            }
        }
    }

    // Metodo para guardar un alllotjament en el documento JSON
    private void saveAllotjaments() {
        Gson gson = new Gson();
        try {
            FileWriter writer = new FileWriter(Constants.JSON_DATA_FILE);
            gson.toJson(allotjaments, writer);
            writer.flush();
            writer.close();
        } catch (IOException ioe) {
            ioe.printStackTrace();
        }
    }
}
