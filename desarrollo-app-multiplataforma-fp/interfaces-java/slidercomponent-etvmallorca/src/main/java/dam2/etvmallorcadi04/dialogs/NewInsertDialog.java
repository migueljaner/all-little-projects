package dam2.etvmallorcadi04.dialogs;

import java.util.List;
import dam2.etvmallorcadi04.Main;
import dam2.etvmallorcadi04.data.DataAccess;
import dam2.etvmallorcadi04.dto.Allotjament;
import dam2.etvmallorcadi04.dto.Municipi;
import dam2.etvmallorcadi04.dto.Usuari;

public class NewInsertDialog extends javax.swing.JDialog {

    private Main framePrincipal;
    private DataAccess da;
    private Usuari user;

    public NewInsertDialog(java.awt.Frame parent, boolean modal) {
        super(parent, modal);
        framePrincipal = (Main) parent;
        this.user = framePrincipal.getUser();
        da = new DataAccess();
        initComponents();
        setTitle("Nuevo Alojamiento");
        fillLocationItems();
    }

    // Metodo para rellenar cmbLocation con los nombres de los Municipi
    private void fillLocationItems() {
        List<Municipi> municipis = da.getMunicipis();
        for (Municipi m : municipis) {
            cmbLocation.addItem(m.getNom());
        }
    }

    // Metodo para crear un nuevo Allotjament
    private Allotjament createNewAllotjament() {
        Allotjament newAllotjament = new Allotjament();
        newAllotjament.setNom(txtName.getText());
        newAllotjament.setDescripcio(txaDescription.getText());
        newAllotjament.setNumPersones((int) spnGuests.getValue());
        newAllotjament.setAdresa(txtAddress.getText());
        newAllotjament.setMunicipi(String.valueOf(cmbLocation.getSelectedItem()));
        newAllotjament.setIdMunicipi(extractIdMunicipi(newAllotjament.getMunicipi()));
        newAllotjament.setIdPropietari(user.getId());
        newAllotjament.setPreuPerNit((float) spnPriceNight.getValue());

        return newAllotjament;
    }

    // Metodo para extraer el id del Municipi al que pertenece el newAllotjament
    private int extractIdMunicipi(String municipi) {
        List<Municipi> municipis = da.getMunicipis();
        int idMunicipi = 0;
        for (Municipi m : municipis) {
            if (municipi.equals(m.getNom())) {
                idMunicipi = m.getId();
                break;
            }
        }
        return idMunicipi;
    }

    // Metodo para decir que tipo de Servei tiene un Allotjament
    private void servicesSelected(int indexNumber) {
        if (chkPool.isSelected()) {
            da.insertServei(1, indexNumber);
        }
        if (chkPets.isSelected()) {
            da.insertServei(2, indexNumber);
        }
        if (chkAC.isSelected()) {
            da.insertServei(3, indexNumber);
        }
        if (chkLift.isSelected()) {
            da.insertServei(4, indexNumber);
        }
        if (chkParking.isSelected()) {
            da.insertServei(5, indexNumber);
        }
        if (chkWifi.isSelected()) {
            da.insertServei(6, indexNumber);
        }
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblName = new javax.swing.JLabel();
        txtName = new javax.swing.JTextField();
        lblAddress = new javax.swing.JLabel();
        txtAddress = new javax.swing.JTextField();
        lblLocation = new javax.swing.JLabel();
        cmbLocation = new javax.swing.JComboBox<>();
        lblGuests = new javax.swing.JLabel();
        spnGuests = new javax.swing.JSpinner();
        lblPriceNight = new javax.swing.JLabel();
        spnPriceNight = new javax.swing.JSpinner();
        lblServices = new javax.swing.JLabel();
        chkPool = new javax.swing.JCheckBox();
        chkPets = new javax.swing.JCheckBox();
        chkAC = new javax.swing.JCheckBox();
        chkLift = new javax.swing.JCheckBox();
        chkParking = new javax.swing.JCheckBox();
        chkWifi = new javax.swing.JCheckBox();
        lblDescription = new javax.swing.JLabel();
        scrDescription = new javax.swing.JScrollPane();
        txaDescription = new javax.swing.JTextArea();
        lblError = new javax.swing.JLabel();
        lblPictures = new javax.swing.JLabel();
        btnInsert = new javax.swing.JButton();
        btnBack = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.DISPOSE_ON_CLOSE);
        getContentPane().setLayout(null);

        lblName.setText("Name:");
        getContentPane().add(lblName);
        lblName.setBounds(20, 20, 60, 30);
        getContentPane().add(txtName);
        txtName.setBounds(120, 20, 740, 30);

        lblAddress.setText("Address:");
        getContentPane().add(lblAddress);
        lblAddress.setBounds(20, 60, 60, 30);
        getContentPane().add(txtAddress);
        txtAddress.setBounds(120, 60, 740, 30);

        lblLocation.setText("Location:");
        getContentPane().add(lblLocation);
        lblLocation.setBounds(20, 100, 60, 30);

        getContentPane().add(cmbLocation);
        cmbLocation.setBounds(120, 100, 140, 30);

        lblGuests.setText("Guests:");
        getContentPane().add(lblGuests);
        lblGuests.setBounds(470, 100, 60, 30);
        getContentPane().add(spnGuests);
        spnGuests.setBounds(530, 100, 80, 30);

        lblPriceNight.setText("Price/Night:");
        getContentPane().add(lblPriceNight);
        lblPriceNight.setBounds(700, 100, 80, 30);

        spnPriceNight.setModel(new javax.swing.SpinnerNumberModel(0.0f, null, null, 0.01f));
        getContentPane().add(spnPriceNight);
        spnPriceNight.setBounds(780, 100, 80, 30);

        lblServices.setText("Services:");
        getContentPane().add(lblServices);
        lblServices.setBounds(20, 180, 80, 40);

        chkPool.setText("Swimming Pool");
        getContentPane().add(chkPool);
        chkPool.setBounds(120, 190, 130, 20);

        chkPets.setText("Pets Allowed");
        getContentPane().add(chkPets);
        chkPets.setBounds(290, 190, 110, 20);

        chkAC.setText("AC");
        getContentPane().add(chkAC);
        chkAC.setBounds(450, 190, 70, 20);

        chkLift.setText("Lift");
        getContentPane().add(chkLift);
        chkLift.setBounds(560, 190, 60, 20);

        chkParking.setText("Parking");
        getContentPane().add(chkParking);
        chkParking.setBounds(680, 190, 80, 20);

        chkWifi.setText("Wifi");
        getContentPane().add(chkWifi);
        chkWifi.setBounds(810, 190, 70, 20);

        lblDescription.setText("Description:");
        getContentPane().add(lblDescription);
        lblDescription.setBounds(20, 270, 80, 16);

        txaDescription.setColumns(20);
        txaDescription.setLineWrap(true);
        txaDescription.setRows(5);
        txaDescription.setWrapStyleWord(true);
        scrDescription.setViewportView(txaDescription);

        getContentPane().add(scrDescription);
        scrDescription.setBounds(120, 270, 740, 120);

        lblError.setForeground(new java.awt.Color(255, 0, 0));
        getContentPane().add(lblError);
        lblError.setBounds(20, 400, 840, 90);

        lblPictures.setBackground(new java.awt.Color(0, 0, 0));
        getContentPane().add(lblPictures);
        lblPictures.setBounds(120, 400, 110, 110);

        btnInsert.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Save.png"))); // NOI18N
        btnInsert.setText("Insert");
        btnInsert.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnInsertActionPerformed(evt);
            }
        });
        getContentPane().add(btnInsert);
        btnInsert.setBounds(760, 520, 90, 27);

        btnBack.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Back.png"))); // NOI18N
        btnBack.setText("Back");
        btnBack.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnBackActionPerformed(evt);
            }
        });
        getContentPane().add(btnBack);
        btnBack.setBounds(660, 520, 90, 27);

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void btnBackActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnBackActionPerformed
        setVisible(false);
    }//GEN-LAST:event_btnBackActionPerformed

    private void btnInsertActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnInsertActionPerformed
        StringBuilder errorMessages = new StringBuilder();

        // Validación de los campos.
        if (txtName.getText().trim().isEmpty()) {
            errorMessages.append("Name is required.\n");
        }
        if (txtAddress.getText().trim().isEmpty()) {
            errorMessages.append("Address is required.\n");
        }
        if (cmbLocation.getSelectedItem() == null) {
            errorMessages.append("Location is required.\n");
        }
        if ((int) spnGuests.getValue() <= 0) {
            errorMessages.append("Guests should be more than 0.\n");
        }
        if ((float) spnPriceNight.getValue() <= 0) {
            errorMessages.append("Price/Night should be more than 0.\n");
        }
        if (txaDescription.getText().trim().isEmpty()) {
            errorMessages.append("Description is required.\n");
        }

        if (errorMessages.length() > 0) {
            lblError.setText("<html>" + errorMessages.toString() + "</html>");
            return; // No se debe seguir si hay errores.
        }

        Allotjament newAllotjament = createNewAllotjament();
        int resultado = da.insertAllotjament(newAllotjament); // Metodo para introducir el nuevo Allotjament en la base de datos
        System.out.println(resultado); // Comprobacion del id_allotjament que se le ha asignado al nuevo Allotjament
        servicesSelected(resultado);
        setVisible(false);
    }//GEN-LAST:event_btnInsertActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {

        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(NewInsertDialog.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(NewInsertDialog.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(NewInsertDialog.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(NewInsertDialog.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }

        /* Create and display the dialog */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                NewInsertDialog dialog = new NewInsertDialog(new javax.swing.JFrame(), true);
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
    private javax.swing.JButton btnInsert;
    private javax.swing.JCheckBox chkAC;
    private javax.swing.JCheckBox chkLift;
    private javax.swing.JCheckBox chkParking;
    private javax.swing.JCheckBox chkPets;
    private javax.swing.JCheckBox chkPool;
    private javax.swing.JCheckBox chkWifi;
    private javax.swing.JComboBox<String> cmbLocation;
    private javax.swing.JLabel lblAddress;
    private javax.swing.JLabel lblDescription;
    private javax.swing.JLabel lblError;
    private javax.swing.JLabel lblGuests;
    private javax.swing.JLabel lblLocation;
    private javax.swing.JLabel lblName;
    private javax.swing.JLabel lblPictures;
    private javax.swing.JLabel lblPriceNight;
    private javax.swing.JLabel lblServices;
    private javax.swing.JScrollPane scrDescription;
    private javax.swing.JSpinner spnGuests;
    private javax.swing.JSpinner spnPriceNight;
    private javax.swing.JTextArea txaDescription;
    private javax.swing.JTextField txtAddress;
    private javax.swing.JTextField txtName;
    // End of variables declaration//GEN-END:variables
}
