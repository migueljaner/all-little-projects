package dam2.etvmallorcadi04.dialogs;

import dam2.etvmallorcadi04.Main;
import dam2.etvmallorcadi04.data.DataAccess;
import dam2.etvmallorcadi04.dto.Usuari;

public class ModifyProfileDialog extends javax.swing.JDialog {

    private Main framePrincipal;
    private DataAccess da;
    private Usuari user;

    public ModifyProfileDialog(java.awt.Frame parent, boolean modal) {
        super(parent, modal);
        framePrincipal = (Main) parent;
        this.user = framePrincipal.getUser();
        da = new DataAccess();
        initComponents();
        pnlPassword.setVisible(false);
        setTitle("Modificar Perfil");
        fillFields();
    }

    // Rellenar los campos principales con la informacion pertinente
    private void fillFields() {
        txtEmail.setText(user.getEmail());
        txtFirstName.setText(user.getNom());
        txtLastName.setText(user.getLlinatges());
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblEmail = new javax.swing.JLabel();
        lblFirstName = new javax.swing.JLabel();
        lblLastName = new javax.swing.JLabel();
        chkChangePassword = new javax.swing.JCheckBox();
        txtEmail = new javax.swing.JTextField();
        txtFirstName = new javax.swing.JTextField();
        txtLastName = new javax.swing.JTextField();
        btnBack = new javax.swing.JButton();
        btnUpdate = new javax.swing.JButton();
        pnlPassword = new javax.swing.JPanel();
        lblOldPassword = new javax.swing.JLabel();
        lblNewPassword = new javax.swing.JLabel();
        lblRepeat = new javax.swing.JLabel();
        pswOldPassword = new javax.swing.JPasswordField();
        pswNewPassword = new javax.swing.JPasswordField();
        pswRepeat = new javax.swing.JPasswordField();
        lblValidation = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        getContentPane().setLayout(null);

        lblEmail.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Email.png"))); // NOI18N
        lblEmail.setText("Email:");
        getContentPane().add(lblEmail);
        lblEmail.setBounds(10, 20, 70, 30);

        lblFirstName.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Name.png"))); // NOI18N
        lblFirstName.setText("First Name:");
        getContentPane().add(lblFirstName);
        lblFirstName.setBounds(10, 60, 100, 30);

        lblLastName.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Name.png"))); // NOI18N
        lblLastName.setText("Last Name:");
        getContentPane().add(lblLastName);
        lblLastName.setBounds(10, 100, 100, 30);

        chkChangePassword.setText("Change Password");
        chkChangePassword.setMargin(new java.awt.Insets(2, 0, 2, 2));
        chkChangePassword.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                chkChangePasswordActionPerformed(evt);
            }
        });
        getContentPane().add(chkChangePassword);
        chkChangePassword.setBounds(10, 140, 140, 30);

        txtEmail.setEditable(false);
        getContentPane().add(txtEmail);
        txtEmail.setBounds(150, 20, 250, 30);
        getContentPane().add(txtFirstName);
        txtFirstName.setBounds(150, 60, 250, 30);
        getContentPane().add(txtLastName);
        txtLastName.setBounds(150, 100, 250, 30);

        btnBack.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Back.png"))); // NOI18N
        btnBack.setText("Back");
        btnBack.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnBackActionPerformed(evt);
            }
        });
        getContentPane().add(btnBack);
        btnBack.setBounds(190, 300, 100, 30);

        btnUpdate.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Save.png"))); // NOI18N
        btnUpdate.setText("Update");
        btnUpdate.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnUpdateActionPerformed(evt);
            }
        });
        getContentPane().add(btnUpdate);
        btnUpdate.setBounds(300, 300, 100, 30);

        pnlPassword.setLayout(null);

        lblOldPassword.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/OldPassword.png"))); // NOI18N
        lblOldPassword.setText("Old Password:");
        pnlPassword.add(lblOldPassword);
        lblOldPassword.setBounds(0, 10, 120, 30);

        lblNewPassword.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Password.png"))); // NOI18N
        lblNewPassword.setText("New Password:");
        pnlPassword.add(lblNewPassword);
        lblNewPassword.setBounds(0, 50, 120, 30);

        lblRepeat.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Repeat.png"))); // NOI18N
        lblRepeat.setText("Repeat Password:");
        pnlPassword.add(lblRepeat);
        lblRepeat.setBounds(0, 90, 140, 30);
        pnlPassword.add(pswOldPassword);
        pswOldPassword.setBounds(140, 10, 250, 30);
        pnlPassword.add(pswNewPassword);
        pswNewPassword.setBounds(140, 50, 250, 30);
        pnlPassword.add(pswRepeat);
        pswRepeat.setBounds(140, 90, 250, 30);

        getContentPane().add(pnlPassword);
        pnlPassword.setBounds(10, 170, 400, 130);

        lblValidation.setForeground(new java.awt.Color(204, 0, 0));
        getContentPane().add(lblValidation);
        lblValidation.setBounds(150, 140, 250, 30);

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void btnBackActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnBackActionPerformed
        setVisible(false);
    }//GEN-LAST:event_btnBackActionPerformed

    // Funcionalidad para actualizar la informacion de un usuario
    private void btnUpdateActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnUpdateActionPerformed
        if (validateChange() && !chkChangePassword.isSelected()) {
            user.setNom(txtFirstName.getText());
            user.setLlinatges(txtLastName.getText());
            da.updateUser(user);
            setVisible(false);
        } else if (validateChange() && chkChangePassword.isSelected()) {
            char[] newPasswordChar = pswNewPassword.getPassword();
            String newPassword = String.valueOf(newPasswordChar);

            user.setNom(txtFirstName.getText());
            user.setLlinatges(txtLastName.getText());
            user.setPassword(newPassword);
            da.updateUser(user);
            setVisible(false);
        }
    }//GEN-LAST:event_btnUpdateActionPerformed

// Mostrar u ocultar los campos referente a la contrasenya
    private void chkChangePasswordActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_chkChangePasswordActionPerformed
        if (chkChangePassword.isSelected()) {
            pnlPassword.setVisible(true);
        } else {
            pnlPassword.setVisible(false);
            // Reset de los campos
            pswOldPassword.setText("");
            pswNewPassword.setText("");
            pswRepeat.setText("");
            lblValidation.setText("");
        }
    }//GEN-LAST:event_chkChangePasswordActionPerformed

    // Metodo de validacion ante cambios en el perfil
    private boolean validateChange() {
        if (txtFirstName.getText() == null || txtFirstName.getText().equals("")) {
            lblValidation.setText("A name must be assigned");
            return false;
        } else if (txtLastName.getText().equals(null) || txtLastName.getText().equals("")) {
            lblValidation.setText("A surname must be assigned");
            return false;
        } else if (chkChangePassword.isSelected()) {
            char[] oldPasswordChar = pswOldPassword.getPassword();
            char[] newPasswordChar = pswNewPassword.getPassword();
            char[] repeatPasswordChar = pswRepeat.getPassword();

            String oldPassword = String.valueOf(oldPasswordChar);
            String newPassword = String.valueOf(newPasswordChar);
            String repeatPassword = String.valueOf(repeatPasswordChar);

            if (oldPassword.equals(null) || oldPassword.equals("") || newPassword.equals(null) || newPassword.equals("") || repeatPassword.equals(null) || repeatPassword.equals("")) {
                lblValidation.setText("All fields must be filled");
                return false;
            } else if (!oldPassword.equals(user.getPassword())) {
                lblValidation.setText("Incorrect old password");
                return false;
            } else if (newPassword.equals(oldPassword)) {
                lblValidation.setText("New password must be different");
                return false;
            } else if (!newPassword.equals(repeatPassword)) {
                lblValidation.setText("New password do not match");
                return false;
            }
        }
        return true;
    }

    public static void main(String args[]) {

        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                ModifyProfileDialog dialog = new ModifyProfileDialog(new javax.swing.JFrame(), true);
                dialog.addWindowListener(new java.awt.event.WindowAdapter() {
                    @Override
                    public void windowClosing(java.awt.event.WindowEvent e) {
                        System.exit(0);
                    }
                });
                dialog.setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnBack;
    private javax.swing.JButton btnUpdate;
    private javax.swing.JCheckBox chkChangePassword;
    private javax.swing.JLabel lblEmail;
    private javax.swing.JLabel lblFirstName;
    private javax.swing.JLabel lblLastName;
    private javax.swing.JLabel lblNewPassword;
    private javax.swing.JLabel lblOldPassword;
    private javax.swing.JLabel lblRepeat;
    private javax.swing.JLabel lblValidation;
    private javax.swing.JPanel pnlPassword;
    private javax.swing.JPasswordField pswNewPassword;
    private javax.swing.JPasswordField pswOldPassword;
    private javax.swing.JPasswordField pswRepeat;
    private javax.swing.JTextField txtEmail;
    private javax.swing.JTextField txtFirstName;
    private javax.swing.JTextField txtLastName;
    // End of variables declaration//GEN-END:variables
}
// cp5WhK
