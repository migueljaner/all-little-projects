package jpanelimagen;
import java.io.File;
import java.io.Serializable;

public class Imagenes implements Serializable{

    File[] imagenes;
        
    public Imagenes () {
        
    }
    
    public Imagenes(File[] fileImagenes) {
        this.imagenes = fileImagenes;
    }

    public File[] getImagen() {
        return imagenes;
    }

    public void setImagenes(File[] imagenesFile) {
        this.imagenes = imagenesFile;
    }

    public File getFotoFromArr(int indice) {
        File foto = imagenes[indice];
        return foto;
    }

}
