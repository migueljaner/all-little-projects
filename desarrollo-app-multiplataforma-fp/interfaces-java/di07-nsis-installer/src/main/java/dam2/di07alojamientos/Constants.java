package dam2.di07alojamientos;

import com.google.gson.reflect.TypeToken;
import java.lang.reflect.Type;
import java.util.ArrayList;

public class Constants {

    // Ruta del directorio principal de la aplicacion. (Para poder posicionarse en la carpeta del usuario (al no saber el nombre en si) se usa "user.home" para partir de esa carpeta)
    public static final String APP_FOLDER = System.getProperty("user.home") + "\\AppData\\Local\\AllotjamentsManager\\";
    // Ruta del directorio de las imagenes
    public static final String IMAGES_FOLDER = System.getProperty("user.home") + "\\AppData\\Local\\AllotjamentsManager\\images\\";
    // Para establecer una imagen de NO-IMAGE
    public static final String NO_IMAGE = "/noImage.png";
    // Indica el tipo de datos de un objeto que se está convirtiendo en formato JSON y viceversa (Serializar y deserializar)
    public static final Type LIST_OF_ALLOTJAMENT_TYPE = new TypeToken<ArrayList<Allotjament>>() {
    }.getType();
    // Ruta del archivo JSON con el contenido de los allotjaments
    public static final String JSON_DATA_FILE = System.getProperty("user.home") + "\\AppData\\Local\\AllotjamentsManager\\allotjaments.json";
    // Anchura de la imagen (por defecto)
    public static final int DEFAULT_IMAGE_WIDTH = 148;
    // Altura de la imagen (por defecto)
    public static final int DEFAULT_IMAGE_HEIGHT = 148;
    // Formato de la imagen (por defecto)
    public static final String DEFAULT_PHOTO_TYPE = "jpg";
}
