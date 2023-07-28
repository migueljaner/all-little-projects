package dam2.etvmallorcadi04.panels;

import java.awt.Image;
import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import dam2.etvmallorcadi04.Main;
import dam2.etvmallorcadi04.data.DataAccess;
import dam2.etvmallorcadi04.dto.Usuari;

public class StartPanel extends javax.swing.JPanel {

    Main jframeMain;
    private DataAccess da;
    private Usuari user;

    public StartPanel(Main jframeMain) {
        initComponents();
        this.jframeMain = jframeMain;
        da = new DataAccess();
        setSize(330, 650);
        // Insercion del logo BK en la lblPic
        setImageLabel(lblPic, "src\\main\\resources\\images\\logo.png");
    }

    // Metodo para ajustar el icono en el lblPic
    private void setImageLabel(JLabel jlabel, String ruta) {
        ImageIcon image = new ImageIcon(ruta);
        Icon icon = new ImageIcon(image.getImage().getScaledInstance(jlabel.getWidth(), jlabel.getHeight(), Image.SCALE_DEFAULT));
        jlabel.setIcon(icon);
//        this.repaint();
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblPic = new javax.swing.JLabel();
        lblValidation = new javax.swing.JLabel();
        lblEmail = new javax.swing.JLabel();
        lblPassword = new javax.swing.JLabel();
        txtEmail = new javax.swing.JTextField();
        pswPassword = new javax.swing.JPasswordField();
        btnLogin1 = new javax.swing.JButton();

        setLayout(null);
        add(lblPic);
        lblPic.setBounds(70, 10, 260, 250);

        lblValidation.setForeground(new java.awt.Color(255, 0, 0));
        add(lblValidation);
        lblValidation.setBounds(130, 230, 240, 30);

        lblEmail.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/User.png"))); // NOI18N
        lblEmail.setText("Email:");
        add(lblEmail);
        lblEmail.setBounds(20, 270, 100, 30);

        lblPassword.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Password.png"))); // NOI18N
        lblPassword.setText("Password:");
        add(lblPassword);
        lblPassword.setBounds(20, 310, 130, 30);
        add(txtEmail);
        txtEmail.setBounds(130, 270, 240, 30);
        add(pswPassword);
        pswPassword.setBounds(130, 310, 240, 30);

        btnLogin1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Login.png"))); // NOI18N
        btnLogin1.setText("Log in");
        btnLogin1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnLogin1ActionPerformed(evt);
            }
        });
        add(btnLogin1);
        btnLogin1.setBounds(240, 350, 130, 31);
    }// </editor-fold>//GEN-END:initComponents

    private void btnLogin1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnLogin1ActionPerformed
        // Extraccion de datos de los campos
        String email = txtEmail.getText();
        char[] passwordChar = pswPassword.getPassword();
        String password = String.valueOf(passwordChar); // Conversion contrasenya de char[] a String
        // Validacion de datos
        if (validarLogin(email, password)) {
            setVisible(false);
            jframeMain.hideLoginPanel();
            jframeMain.showFrameBar();
            jframeMain.showMainPage(da.getUser(email));
            jframeMain.setUser(da.getUser(email));
            // Hacer reset de los campos para cuando se cambie de Usuari
            txtEmail.setText("");
            pswPassword.setText("");
            lblValidation.setText("");
        }
    }//GEN-LAST:event_btnLogin1ActionPerformed

    // Metodo validacion en el Login
    private boolean validarLogin(String email, String password) {
        user = da.getUser(email);

        if (user == null || email.equals(null) || email.equals("")) {
            lblValidation.setText("Incorrect email address");
            // JOptionPane.showMessageDialog(this, "Incorrect email address", "Validation Error", JOptionPane.ERROR_MESSAGE);
            return false;
        } else if (!password.equals(da.findUserPassword(email))) {
            lblValidation.setText("Incorrect password");
            // JOptionPane.showMessageDialog(this, "Incorrect password", "Validation Error", JOptionPane.ERROR_MESSAGE);
            return false;
        }
        return true;
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnLogin1;
    private javax.swing.JLabel lblEmail;
    private javax.swing.JLabel lblPassword;
    private javax.swing.JLabel lblPic;
    private javax.swing.JLabel lblValidation;
    private javax.swing.JPasswordField pswPassword;
    private javax.swing.JTextField txtEmail;
    // End of variables declaration//GEN-END:variables
}
