package dam2.etvmallorcadi04;

import com.formdev.flatlaf.FlatLightLaf;
import dam2.etvmallorcadi04.panels.StartPanel;
import dam2.etvmallorcadi04.dialogs.NewInsertDialog;
import dam2.etvmallorcadi04.panels.MainPage;
import java.awt.Font;
import java.awt.event.KeyEvent;
import javax.swing.JPanel;
import javax.swing.UIDefaults;
import javax.swing.UIManager;
import dam2.etvmallorcadi04.dialogs.ModifyProfileDialog;
import dam2.etvmallorcadi04.dto.Usuari;

public class Main extends javax.swing.JFrame {

    private StartPanel startPanel;
    private MainPage mainPage;
    private NewInsertDialog newInsertDialog;
    private ModifyProfileDialog modifyProfileDialog;
    private Usuari user;

    public Main() {

        // Inicializaciones
        startPanel = new StartPanel(this);
        // Generacion, fijacion y centtralizacion del Jframe
        initComponents();
        //setSize(1800, 1000);
        setLocationRelativeTo(null);
        mnuBar.setVisible(false);
        createShortcuts();
        // Mostramos el JPanel inicial
        createLoginPanel();
    }

    public Usuari getUser() {
        return this.user;
    }

    public void setUser(Usuari user) {
        this.user = user;
    }

    // Metodo para posicionar JPanels al centro del JFrame
    private void putCenter(JPanel jpanel, int width, int height) {
        int centerX = getWidth() / 2;
        int centerY = getHeight() / 2;
        int x = centerX - (width / 2);
        int y = centerY - (height / 2);
        jpanel.setBounds(x, y, width, height);
    }

    // Metodo para crear y acceder al JPanel inicial (StartPanel)
    private void createLoginPanel() {
        putCenter(startPanel, 390, 500);
        getContentPane().add(startPanel);
    }

    // Ocultar StartPanel
    public void hideLoginPanel() {
        startPanel.setVisible(false);
    }

    // Metodo para mostrar el Jpanel principal (MainPage)
    public void showMainPage(Usuari user) {
        mainPage = new MainPage(this, user);
        putCenter(mainPage, 1700, 800);
        getContentPane().add(mainPage);

    }

    // Mostrar la barra de Menu (mnuBar)
    public void showFrameBar() {
        mnuBar.setVisible(true);
    }

    // Creacion de Shortcuts para la Barra de Menu a traves de Alt + la tecla seleccionada
    private void createShortcuts() {
        mnuInsert.setMnemonic(KeyEvent.VK_I);
        mnuProfile.setMnemonic(KeyEvent.VK_P);
    }

    // Metodo para mostrar el JDialog para introducir un nuevo Allotjament
    private void showNewInsertDialog() {
        newInsertDialog = new NewInsertDialog(this, true);
        newInsertDialog.setSize(900, 620);
        newInsertDialog.setLocationRelativeTo(null);
        newInsertDialog.setVisible(true);
    }

    // Metodo para mostrar el JDialog para modificar la cuenta de usuario
    private void showModifyProfileDialog() {
        modifyProfileDialog = new ModifyProfileDialog(this, true);
        modifyProfileDialog.setSize(430, 380);
        modifyProfileDialog.setLocationRelativeTo(null);
        modifyProfileDialog.setVisible(true);
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        mnuBar = new javax.swing.JMenuBar();
        mnuInsert = new javax.swing.JMenu();
        mniNew = new javax.swing.JMenuItem();
        mnuProfile = new javax.swing.JMenu();
        mniChangeProfile = new javax.swing.JMenuItem();
        mniLogOut = new javax.swing.JMenuItem();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("Empresa BK");
        setMinimumSize(new java.awt.Dimension(1800, 1000));

        mnuInsert.setText("Insertar");

        mniNew.setAccelerator(javax.swing.KeyStroke.getKeyStroke(java.awt.event.KeyEvent.VK_N, java.awt.event.InputEvent.ALT_DOWN_MASK));
        mniNew.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Add.png"))); // NOI18N
        mniNew.setText("Nuevo Alojamiento");
        mniNew.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                mniNewActionPerformed(evt);
            }
        });
        mnuInsert.add(mniNew);

        mnuBar.add(mnuInsert);

        mnuProfile.setText("Perfil");

        mniChangeProfile.setAccelerator(javax.swing.KeyStroke.getKeyStroke(java.awt.event.KeyEvent.VK_M, java.awt.event.InputEvent.ALT_DOWN_MASK));
        mniChangeProfile.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Edit.png"))); // NOI18N
        mniChangeProfile.setText("Modificar Perfil");
        mniChangeProfile.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                mniChangeProfileActionPerformed(evt);
            }
        });
        mnuProfile.add(mniChangeProfile);

        mniLogOut.setAccelerator(javax.swing.KeyStroke.getKeyStroke(java.awt.event.KeyEvent.VK_L, java.awt.event.InputEvent.ALT_DOWN_MASK));
        mniLogOut.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Logout.png"))); // NOI18N
        mniLogOut.setText("Cerrar Sesión");
        mniLogOut.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                mniLogOutActionPerformed(evt);
            }
        });
        mnuProfile.add(mniLogOut);

        mnuBar.add(mnuProfile);

        setJMenuBar(mnuBar);

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 1138, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 654, Short.MAX_VALUE)
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void mniNewActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_mniNewActionPerformed
        showNewInsertDialog();
        mainPage.fillTableAllotjaments(); // Metodo para refrescar la tabla ante cambios
    }//GEN-LAST:event_mniNewActionPerformed

    private void mniLogOutActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_mniLogOutActionPerformed
        mainPage.setVisible(false);
        mnuBar.setVisible(false);
        startPanel.setVisible(true);
    }//GEN-LAST:event_mniLogOutActionPerformed

    private void mniChangeProfileActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_mniChangeProfileActionPerformed
        showModifyProfileDialog();
        mainPage.refreshName(user); // Metodo para refrescar el mensaje de bienvenida ante cambios
    }//GEN-LAST:event_mniChangeProfileActionPerformed

    public static void main(String args[]) {
        FlatLightLaf.setup();

        try {
            // Establecer un formato especifico de fuente para los JButtons y JLabels
            Font myFont = new Font("Arial", Font.BOLD, 10);

            UIDefaults dUI = UIManager.getDefaults();
            dUI.put("Button.font", myFont);
            dUI.put("Label.font", myFont);
            dUI.put("Menu.font", myFont);
            dUI.put("MenuItem.font", myFont);

            //Aqui podemos poner el class name del tema seleccionado de FlatMac (en nuestro caso, elegimos FlatMacLightLaf)
            UIManager.setLookAndFeel("com.formdev.flatlaf.themes.FlatMacLightLaf");

        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Main().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JMenuItem mniChangeProfile;
    private javax.swing.JMenuItem mniLogOut;
    private javax.swing.JMenuItem mniNew;
    private javax.swing.JMenuBar mnuBar;
    private javax.swing.JMenu mnuInsert;
    private javax.swing.JMenu mnuProfile;
    // End of variables declaration//GEN-END:variables
}
