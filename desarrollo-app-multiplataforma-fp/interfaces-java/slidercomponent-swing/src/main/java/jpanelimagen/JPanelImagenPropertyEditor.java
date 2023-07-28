package jpanelimagen;

import java.awt.Component;
import java.beans.PropertyEditorSupport;
import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.util.ArrayList;

public class JPanelImagenPropertyEditor extends PropertyEditorSupport {

    private JPanelImagenPanel propPanel = new JPanelImagenPanel();

    @Override
    public boolean supportsCustomEditor() {
        return true; // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
    }

    @Override
    public Component getCustomEditor() {
        return propPanel; // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
    }

    @Override
    public String getJavaInitializationString() {
        ArrayList<byte[]> arr_Imagenes = propPanel.getImagenes();

        Imagenes array_Files = convertByteArraysToImagenes(arr_Imagenes);

        JPanelImagen comp = new JPanelImagen();

        return "new jpanelimagen.Imagenes(\"" + "new java.io.File[](" + array_Files.getFotoFromArr(comp.getCurrentImageIndex()).getAbsolutePath() + "\"))";// Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
    }

    @Override
    public Object getValue() {
        return propPanel.getImagenes(); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
    }

    private Imagenes convertByteArraysToImagenes(ArrayList<byte[]> arr_Imagenes) {
        // this will hold the image files we're creating
        File[] fileArray = new File[arr_Imagenes.size()];

        int i = 0;
        for (byte[] imageBytes : arr_Imagenes) {
            try {
                // create a temp file for each image
                File tempFile = File.createTempFile("image" + i, ".jpg"); // Change the file extension based on your image type
                Files.write(tempFile.toPath(), imageBytes); // write the bytes to the file

                fileArray[i] = tempFile;
            } catch (IOException e) {
                e.printStackTrace();
            }
            i++;
        }

        return new Imagenes(fileArray);
    }
}
