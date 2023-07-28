package gui;

import dto.Usuari;

public class Main extends javax.swing.JFrame {

    private Usuari logedUser;

    public Main() {
        //Se comprueba si el usuario esta logeado.
        isLogedIn(false);
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setBounds(new java.awt.Rectangle(540, 160, 800, 600));
        setPreferredSize(new java.awt.Dimension(800, 600));
        setResizable(false);
        setSize(new java.awt.Dimension(800, 600));
        getContentPane().setLayout(null);

        pack();
    }// </editor-fold>//GEN-END:initComponents

    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Main.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Main().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    // End of variables declaration//GEN-END:variables
    //Variables de JPanel
    private PnlLogOut pnlLogOut;
    private PnlLoged pnlLoged;
    private PnlLogin pnlLogin;

    //Si esta logeado muestra el panel de usuario, sino  la ventana de login.
    public void isLogedIn(boolean state) {
        
        if (!state) {
            getContentPane().removeAll();
            initComponents();
            initLogInComponents();
        } else {
            getContentPane().removeAll();
            initComponents();
            initUserComponents();
        }
    }
    //Iicia la ventana de login
    private void initLogInComponents() {
        pnlLogin = new PnlLogin(this);
        getContentPane().add(pnlLogin);
        pnlLogin.setBounds(0, 60, 800, 540);
    }
    //Inicia el panel de usuario
    private void initUserComponents() {
        pnlLogOut = new PnlLogOut(this);
        pnlLoged = new PnlLoged(this);

        //Añadimos el panel de LogOut
        getContentPane().add(pnlLogOut);
        pnlLogOut.setBounds(0, 0, 800, 60);
        pnlLogOut.getLblBienvenida().setText("Bienvenido/a " + logedUser.getNom());

        //Añadimos el panel de Usuario
        getContentPane().add(pnlLoged);
        pnlLoged.setBounds(0, 60, 800, 540);
    }
    //Seteamos el usuario logeado
    public void setUserLogged(Usuari logedUser) {
        this.logedUser = logedUser;
    }
    //Recogemos el usuario logeado.
    public Usuari getUserLogged() {
        return this.logedUser;
    }
}
