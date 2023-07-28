/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package jpanelimagen;

import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.io.Serializable;
import java.util.ArrayList;
import javax.swing.ImageIcon;
import javax.swing.JPanel;
import javax.swing.Timer;

/**
 *
 * @author Miquel
 */
public class JPanelImagen extends JPanel implements Serializable {

    private ArrayList<byte[]> images;
    private Integer currentImageIndex = 0;
    private int segChange;
    private Timer changeImage;
    int ParentHeight;
    int ParentWidth;

    public JPanelImagen() {

    }

    public JPanelImagen(ArrayList<byte[]> images, int seg, int ParentHeight, int ParentWidth) {

        this.images = images;
        currentImageIndex = 0;
        this.ParentHeight = ParentHeight;
        this.ParentWidth = ParentWidth;
        this.segChange = seg;

    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        if (this.images != null && !images.isEmpty()) {
            Image currentImage = byteArrayToImage(images.get(currentImageIndex)).getImage();

            Dimension imgSize = new Dimension(currentImage.getWidth(null), currentImage.getHeight(null));
            Dimension boundary = new Dimension(ParentWidth, ParentHeight);
            Dimension newDimension = getScaledDimension(imgSize, boundary);

            g.drawImage(currentImage, 0, 0, newDimension.width, newDimension.height, null);
        }

    }

    public void nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.size();
        repaint();

    }

    public void previousImage() throws IndexOutOfBoundsException {
        currentImageIndex = (currentImageIndex - 1) % images.size();
        if (currentImageIndex < 0) {
            currentImageIndex = 0;
        }
        repaint();
    }

    public void autoSlider() {

        changeImage = null;
        changeImage = new Timer(segChange, (ActionEvent e1) -> {
            currentImageIndex = (currentImageIndex - 1 + images.size()) % images.size();
            repaint();

        });
        changeImage.start();
    }

    public void stopSlider() {

        changeImage.stop();

    }

    public ArrayList<byte[]> getImages() {
        return images;
    }

    public void setImages(ArrayList<byte[]> fileImages) {

        this.images = fileImages;
    }

    public int getCurrentImageIndex() {
        return currentImageIndex;
    }

    public void setCurrentImageIndex(int currentImageIndex) {
        this.currentImageIndex = currentImageIndex;
    }

    public int getSegChange() {
        return segChange;
    }

    public void setSegChange(int segChange) {
        this.segChange = segChange;
    }

    public static Dimension getScaledDimension(Dimension imgSize, Dimension boundary) {

        int original_width = imgSize.width;
        int original_height = imgSize.height;
        int bound_width = boundary.width;
        int bound_height = boundary.height;
        int new_width = original_width;
        int new_height = original_height;

        // first check if we need to scale width
        if (original_width > bound_width) {
            //scale width to fit
            new_width = bound_width;
            //scale height to maintain aspect ratio
            new_height = (new_width * original_height) / original_width;
        }

        // then check if we need to scale even with the new height
        if (new_height > bound_height) {
            //scale height to fit instead
            new_height = bound_height;
            //scale width to maintain aspect ratio
            new_width = (new_height * original_width) / original_height;
        }

        return new Dimension(new_width, new_height);
    }

    public static void maim(String args[]) {
        new JPanelImagen();
    }

    public static ImageIcon byteArrayToImage(byte[] image) {
        ImageIcon icon = new ImageIcon(image);
        return icon;
    }

    public String getFullInfo() {
        String str = "Empty";
        if (images != null && !images.isEmpty()) {
            String id = Integer.toString(currentImageIndex);
            String size = Integer.toString(images.get(currentImageIndex).length / 1024);
            str = "Index: " + id + " Size : " + size + "Kb";
        }

        return str;
    }

}
