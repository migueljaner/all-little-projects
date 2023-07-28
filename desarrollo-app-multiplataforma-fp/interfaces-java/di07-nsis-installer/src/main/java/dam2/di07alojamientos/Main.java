package dam2.di07alojamientos;

import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JFileChooser;
import javax.swing.JOptionPane;

public class Main extends javax.swing.JFrame {

    JFileChooser fileChooser = new JFileChooser();
    DataAccess da = new DataAccess();

    public Main() {
        initComponents();
        setLocationRelativeTo(null);
        insertLogo();
        pnlAllotjaments.setLayout(new WrapLayout());
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblName = new javax.swing.JLabel();
        txtName = new javax.swing.JTextField();
        lblAddress = new javax.swing.JLabel();
        txtAddress = new javax.swing.JTextField();
        lblLocation = new javax.swing.JLabel();
        txtLocation = new javax.swing.JTextField();
        lblGuests = new javax.swing.JLabel();
        spnGuests = new javax.swing.JSpinner();
        lblDescription = new javax.swing.JLabel();
        scrDescription = new javax.swing.JScrollPane();
        txaDescription = new javax.swing.JTextArea();
        lblImage = new javax.swing.JLabel();
        btnImage = new javax.swing.JButton();
        lblPic = new javax.swing.JLabel();
        btnInsert = new javax.swing.JButton();
        scrAllotjaments = new javax.swing.JScrollPane();
        pnlAllotjaments = new javax.swing.JPanel();
        btnShow = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("ProjectDI07");
        addWindowListener(new java.awt.event.WindowAdapter() {
            public void windowOpened(java.awt.event.WindowEvent evt) {
                formWindowOpened(evt);
            }
        });

        lblName.setText("Name:");

        lblAddress.setText("Address:");

        lblLocation.setText("Location:");

        lblGuests.setText("Guests:");

        lblDescription.setText("Description:");

        txaDescription.setColumns(20);
        txaDescription.setRows(5);
        scrDescription.setViewportView(txaDescription);

        lblImage.setText("Image:");

        btnImage.setText("...");
        btnImage.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnImageActionPerformed(evt);
            }
        });

        btnInsert.setText("Insert");
        btnInsert.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnInsertActionPerformed(evt);
            }
        });

        pnlAllotjaments.setBorder(javax.swing.BorderFactory.createTitledBorder("Allotjaments"));

        javax.swing.GroupLayout pnlAllotjamentsLayout = new javax.swing.GroupLayout(pnlAllotjaments);
        pnlAllotjaments.setLayout(pnlAllotjamentsLayout);
        pnlAllotjamentsLayout.setHorizontalGroup(
            pnlAllotjamentsLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 552, Short.MAX_VALUE)
        );
        pnlAllotjamentsLayout.setVerticalGroup(
            pnlAllotjamentsLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 469, Short.MAX_VALUE)
        );

        scrAllotjaments.setViewportView(pnlAllotjaments);

        btnShow.setText("Show Allotjaments");
        btnShow.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnShowActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(layout.createSequentialGroup()
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(btnShow))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(14, 14, 14)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(lblName, javax.swing.GroupLayout.PREFERRED_SIZE, 48, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(21, 21, 21)
                                .addComponent(txtName))
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(lblDescription)
                                    .addComponent(lblGuests)
                                    .addComponent(lblImage, javax.swing.GroupLayout.PREFERRED_SIZE, 45, javax.swing.GroupLayout.PREFERRED_SIZE))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(layout.createSequentialGroup()
                                        .addComponent(btnImage)
                                        .addGap(18, 18, 18)
                                        .addComponent(lblPic, javax.swing.GroupLayout.PREFERRED_SIZE, 148, javax.swing.GroupLayout.PREFERRED_SIZE))
                                    .addComponent(scrDescription, javax.swing.GroupLayout.PREFERRED_SIZE, 295, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addComponent(spnGuests, javax.swing.GroupLayout.PREFERRED_SIZE, 72, javax.swing.GroupLayout.PREFERRED_SIZE)))
                            .addComponent(btnInsert, javax.swing.GroupLayout.Alignment.TRAILING)
                            .addGroup(layout.createSequentialGroup()
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                                    .addComponent(lblAddress, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                    .addComponent(lblLocation, javax.swing.GroupLayout.DEFAULT_SIZE, 57, Short.MAX_VALUE))
                                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(layout.createSequentialGroup()
                                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                                        .addComponent(txtLocation))
                                    .addGroup(layout.createSequentialGroup()
                                        .addGap(12, 12, 12)
                                        .addComponent(txtAddress)))))
                        .addGap(18, 18, 18)
                        .addComponent(scrAllotjaments, javax.swing.GroupLayout.PREFERRED_SIZE, 554, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addContainerGap(25, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(35, 35, 35)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(lblName, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(txtName, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(lblAddress, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(txtAddress, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(17, 17, 17)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(lblLocation, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(txtLocation, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(lblGuests, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(spnGuests, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(lblDescription, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(scrDescription, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(lblPic, javax.swing.GroupLayout.PREFERRED_SIZE, 148, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                .addComponent(btnImage)
                                .addComponent(lblImage, javax.swing.GroupLayout.PREFERRED_SIZE, 27, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addGap(18, 18, 18)
                        .addComponent(btnInsert))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                        .addGap(12, 12, 12)
                        .addComponent(scrAllotjaments, javax.swing.GroupLayout.PREFERRED_SIZE, 471, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(btnShow)
                .addContainerGap(10, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    // Boton para seleccionar una imagen para el Allotjament
    private void btnImageActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnImageActionPerformed
        int value = fileChooser.showDialog(this, "Select Picture");
        if (value == JFileChooser.APPROVE_OPTION) {
            try {
                BufferedImage photo = ImageIO.read(fileChooser.getSelectedFile());
                BufferedImage resizedPhoto = Utilities.resizeImageIcon(photo, lblPic.getWidth(), lblPic.getHeight());
                lblPic.setIcon(new ImageIcon(resizedPhoto));
            } catch (IOException e) {
                System.err.println("IOExceptior Error: " + e.getMessage());
            }
        }
    }//GEN-LAST:event_btnImageActionPerformed

    private void btnInsertActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnInsertActionPerformed
        if (txtName.getText().equals("") || txtAddress.getText().equals("") || txtLocation.getText().equals("") || (int) spnGuests.getValue() == 0 || txaDescription.getText().equals("")) { // En caso de que algun campo no sea rellenado
            JOptionPane.showMessageDialog(this, "Todos los campos son obligatorios");
        } else { // En caso de que se rellenen todos los campos
            Allotjament newAllotjament = new Allotjament();
            newAllotjament.setName(txtName.getText());
            newAllotjament.setAddress(txtAddress.getText());
            newAllotjament.setLocation(txtLocation.getText());
            newAllotjament.setGuests((int) spnGuests.getValue());

            try {
                if (fileChooser.getSelectedFile() != null) {
                    da.insertAllotjament(newAllotjament, fileChooser.getSelectedFile().getAbsolutePath());
                } else {
                    da.insertAllotjament(newAllotjament, Constants.NO_IMAGE);
                }
                AllotjamentComponent allotjamentComponent = new AllotjamentComponent();
                BufferedImage originalImage;
                originalImage = ImageIO.read(new File(Constants.IMAGES_FOLDER + newAllotjament.getImage()));
                BufferedImage resizedBufferedImage = Utilities.resizeImageIcon(originalImage, 148, 148);
                allotjamentComponent.setData(new ImageIcon(resizedBufferedImage), newAllotjament);
                pnlAllotjaments.add(allotjamentComponent);
                pnlAllotjaments.revalidate();
                scrAllotjaments.getVerticalScrollBar().setValue(scrAllotjaments.getVerticalScrollBar().getMaximum() + 300);
                resetFields();
            } catch (Exception ex) {
                JOptionPane.showMessageDialog(this, ex.getMessage());
                ex.printStackTrace();
            }
        }
    }//GEN-LAST:event_btnInsertActionPerformed

    // Boton para cargar los allotjaments inscritos
    private void btnShowActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnShowActionPerformed
        ArrayList<Allotjament> allotjaments = da.getAllotjaments();
        if (allotjaments != null) {
            pnlAllotjaments.removeAll(); // Instrucción para eliminar el contenido anterior
            for (Allotjament a : da.getAllotjaments()) {
                AllotjamentComponent allotjamentComponent = new AllotjamentComponent();
                BufferedImage originalImage;
                try {
                    originalImage = ImageIO.read(new File(Constants.IMAGES_FOLDER + a.getImage()));
                    BufferedImage resizedBufferedImage = Utilities.resizeImageIcon(originalImage, 148, 148);
                    allotjamentComponent.setData(new ImageIcon(resizedBufferedImage), a);
                    pnlAllotjaments.add(allotjamentComponent);
                    pnlAllotjaments.revalidate(); // Instrucción para pintar el contenido del componenete
                } catch (IOException ex) {
                    Logger.getLogger(Main.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        }
    }//GEN-LAST:event_btnShowActionPerformed

    private void formWindowOpened(java.awt.event.WindowEvent evt) {//GEN-FIRST:event_formWindowOpened
        btnShow.doClick();
    }//GEN-LAST:event_formWindowOpened

    private void resetFields() {
        txtName.setText("");
        txtAddress.setText("");
        txtLocation.setText("");
        spnGuests.setValue(0);
        txaDescription.setText("");
        lblPic.setIcon(new ImageIcon(Constants.NO_IMAGE));
    }

    // Metodo para cargar el logo del proyecto como el icono de la ventana
    private void insertLogo() {
        ImageIcon icon = new ImageIcon(getClass().getResource("/logo.png"));
        this.setIconImage(icon.getImage());
    }

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
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Main().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnImage;
    private javax.swing.JButton btnInsert;
    private javax.swing.JButton btnShow;
    private javax.swing.JLabel lblAddress;
    private javax.swing.JLabel lblDescription;
    private javax.swing.JLabel lblGuests;
    private javax.swing.JLabel lblImage;
    private javax.swing.JLabel lblLocation;
    private javax.swing.JLabel lblName;
    private javax.swing.JLabel lblPic;
    private javax.swing.JPanel pnlAllotjaments;
    private javax.swing.JScrollPane scrAllotjaments;
    private javax.swing.JScrollPane scrDescription;
    private javax.swing.JSpinner spnGuests;
    private javax.swing.JTextArea txaDescription;
    private javax.swing.JTextField txtAddress;
    private javax.swing.JTextField txtLocation;
    private javax.swing.JTextField txtName;
    // End of variables declaration//GEN-END:variables
}
