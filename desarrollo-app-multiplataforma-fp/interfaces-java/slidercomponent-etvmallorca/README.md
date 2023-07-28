# ProjectDI04

<p>Este proyecto tiene como objetivo optimizar y mejorar la aplicación desarrollada a lo largo del curso, centrándonos en mejorar la usabilidad. Seguiremos los criterios de calificación establecidos.</p>

## Cambiar la apariencia de las ventanas

<p>En esta sección hemos seleccionado un tema diferente de "Look And Feel" proporcionado por FlatLaf. Hemos explorado los temas disponibles en FlatLaf (https://www.formdev.com/flatlaf/themes/) y hemos agregado la dependencia de FlatLaf. La dependencia se descargó desde el siguiente sitio web:</p>

```
<!-- https://www.formdev.com/flatlaf/themes/ -->
        <dependency>
            <groupId>com.formdev</groupId>
            <artifactId>flatlaf</artifactId>
            <version>3.0</version>
            <type>jar</type>
        </dependency>

```

<p>Una vez que la dependencia se haya agregado al archivo pom.xml, nos dirigimos al método main() de nuestra clase principal. Podemos observar que el "Look And Feel" predeterminado es Nimbus. Para cambiar la apariencia de nuestras ventanas, primero eliminamos el contenido del bloque try (las excepciones capturadas en el bloque catch pueden permanecer intactas) y luego insertamos el siguiente bloque de código: </p>

```
//Aqui podemos poner el class name del tema seleccionado de FlatMac (en nuestro caso, elegimos FlatMacLightLaf)
UIManager.setLookAndFeel("com.formdev.flatlaf.themes.FlatMacLightLaf");
```

<p>Además, para mejorar la orientación del usuario, tanto el frame principal como las ventanas emergentes (como la modificación del perfil o la introducción de un nuevo alojamiento) que aparecen a lo largo de la aplicación llevarán un título identificativo en la parte superior izquierda, utilizando la siguiente sentencia de código:</p>

```
setTitle("NombreDeLaVentana");
```
## Modificación de la fuente

<p> En esta sección nos enfocaremos en mejorar la legibilidad y el atractivo visual de nuestra aplicación a nivel de texto. Podemos utilizar una fuente proporcionada por NetBeans (Herramientas > Opciones > Fuentes y Colores) o descargar fuentes externas de https://www.dafont.com/es/. En nuestro caso, hemos optado por usar una fuente interna diferente a la predeterminada de NetBeans. Esta modificación se aplica a todos los JButtons, JLabels, JMenus y JMenuItems. Representa un cambio en la fuente, estilo y tamaño, como se puede apreciar. Para aplicar este cambio de manera general, nos dirigimos nuevamente al método main() de nuestra clase principal y agregamos el siguiente bloque de código: </p>

```
// Establecer un formato especifico de fuente para los JButtons y JLabels
            Font myFont = new Font("Arial", Font.BOLD, 10);

            UIDefaults dUI = UIManager.getDefaults();
            dUI.put("Button.font", myFont);
            dUI.put("Label.font", myFont);
            dUI.put("Menu.font", myFont);
            dUI.put("MenuItem.font", myFont);
```

## Incorporación de iconos 

<p>En esta sección vamos a incluir una serie de iconos en diferentes componentes de nuestra aplicación. Se han agregado iconos en:</p>

- En el login, sobre las etiquetas de Email y Password.
- En la barra de menú, específicamente en el ítem New Accommodation al desglosar la opción de Insert, y en los ítems Modify Profile y Log Out al desglosar la opción de Profile
- En la ventana emergente donde se modifican los datos del perfil, se han añadido iconos a las etiquetas Email, First Name, Last Name, Old Password, New Password y Repeat Password
- En diferentes botones, como Save, Insert, Back, Log in, Update, Reply, Answer, y en botones para visualizar la imagen anterior o siguiente.

## Redefinición de los layouts

<p>No se ha logrado llevar a cabo de manera satisfactoria este apartado. Se han enfrentado los siguientes problemas:</p>

- <p>Al intentar cambiar el layout de los JDialogs y los JPanels a "Free Design", la aplicación presentaba errores y no se ejecutaba correctamente.</p>
- <p>Al agregar JPanels externos al boceto del frame principal, no se ha encontrado la opción de "Auto-Resizing", por lo que no se ha podido redimensionar los componentes al modificar el tamaño del frame principal.</p>

## Distribución de los componentes

<p>En esta sección, se han tomado una serie de medidas para mejorar la fluidez de uso e interacción con la aplicación. Estos cambios se centran principalmente en la eliminación de ventanas o diálogos emergentes.</p>

<p>Se ha simplificado el proceso de inicio de sesión del proyecto, incorporando los campos de credenciales en el mismo panel inicial y eliminando el botón de Login que llevaba al loginDialog para ingresar las credenciales.</p>

<p> En cuanto a la organización del proyecto, los componentes están centrados, tanto los JDialogs emergentes como los JPanels sobre el JFrame. Después de iniciar sesión, se muestra una barra de menú en la parte superior que permite agregar un nuevo alojamiento o realizar ciertas acciones relacionadas con el perfil. Además, en la parte central izquierda, se muestra una lista de los alojamientos del usuario. Estos alojamientos se dividen en 3 columnas (Name, Address y Place), que se pueden ordenar de forma ascendente o descendente siguiendo el orden alfanumérico.</p>

<p> Al seleccionar un alojamiento, se muestra un nuevo panel en la parte central derecha con todos los datos correspondientes. En este panel, el propietario puede consultar o modificar ciertos valores del alojamiento. Se ha corregido la visualización de los diferentes servicios, transformando los Radio Buttons en Check Boxes. Además, se han alineado todos los subcomponentes para crear un diseño simétrico.</p>

<p>A nivel de desarrollo, se ha reorganizado de forma más clara y limpia las diferentes clases del proyecto, creando dos paquetes nuevos:</p>

- <em>Panels:</em> contiene todos los JPanels de la aplicación.
- <em>Dialogs</em> contiene todos los JDialogs de la aplicación.

## Gestión de errores y excepciones

<p>En este apartado, se ha trabajado en mejorar la gestión de errores en el proceso de inicio de sesión y al modificar la información del perfil del usuario.</p> 

<p>En el proceso de inicio de sesión, se han eliminado las ventanas emergentes y se ha optado por mostrar mensajes de error en un JLabel de color rojo. Si el email ingresado es incorrecto, se mostrará un mensaje indicando que el email no es válido. Si la contraseña ingresada es incorrecta, se mostrará un mensaje indicando que la contraseña es incorrecta.</p>

<p>En el proceso de creacion de un nuevo alojamiento se han añadido mensajes de error a la hora de introducir un campo erroneo. Por ejemplo, si no se introduce cualquier imput que sea necesario para la creación del mismo.</p>

<p align="justify">Tambien se ha realizado un control de errores más completo y quisquilloso a la hora de modificar el usuario en cuestión. Los errores que se muestran al usuario a la hora de modificar sus datos personales son los siguientes:</p>

- Notificación de que los campos no pueden estar vacíos (First Name, Last Name, Old Password, New Password y Repeat Password).
- Notificación de que, para realizar cambios en la contraseña, se debe ingresar la contraseña actual como medida de seguridad.
- Notificación de que, para realizar cambios en la contraseña, la nueva contraseña debe ser diferente a la actual.
- Notificación de que, para realizar cambios en la contraseña, la nueva contraseña debe coincidir con la que se ingresa en el campo Repeat Password.

<p>Estas notificaciones se mostrarán en un JLabel de color rojo, al igual que en el apartado de inicio de sesión.<p>

## Nuevas funcionalidades

<b><u>GESTIÓN DE LOS DATOS PERSONALES DEL USUARIO</u></b>

<p>Para esta funcionalidad se ha creado un nuevo JDialog que se abre desde la opción "Modify Profile" en el menú "Profile". Al abrir el diálogo, se muestran los siguientes elementos:</p>

- El email del usuario (no editable).
- El nombre del usuario.
- Los apellidos del usuario.
- Un casilla de verificación llamada "Change Password" para habilitar o deshabilitar la opción de modificar la contraseña.

<p align="justify">Si no se desea cambiar la contraseña, debemos dejar dicha casilla desmarcada. En caso contrario, al marcar la casilla nos aparecerán otra serie de casillas que debemos rellenar:</p>

- La contraseña actual para poder efectuar el cambio y garantizar la seguridad del usuario (<em>Old Password</em>).
- La contraseña nueva con la que se desea acceder desde ese momento en adelante.
- Repetir la contraseña nueva por cuestiones de seguridad y verificación de la misma.

<p>Si no se desea cambiar la contraseña, se debe dejar la casilla desmarcada. En caso de marcarla, se muestran campos adicionales para ingresar la contraseña actual, la nueva contraseña y repetir la nueva contraseña para verificación.</p>

<p>Para guardar los cambios, se debe hacer clic en el botón "Update", lo que actualizará los datos de manera persistente y llevará de vuelta a la ventana principal de la aplicación. Si se desea salir sin guardar los cambios, se puede hacer clic en el botón "Back".</p>

Para persistir los cambios, se ha creado un nuevo método llamado updateUser() en la clase DataAccess. Aquí se muestra un ejemplo de cómo se realiza la actualización en la base de datos:

```
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
```
