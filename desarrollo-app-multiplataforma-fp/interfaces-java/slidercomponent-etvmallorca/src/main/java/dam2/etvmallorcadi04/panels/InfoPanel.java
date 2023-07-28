package dam2.etvmallorcadi04.panels;

import java.util.List;
import javax.swing.JPanel;
import dam2.etvmallorcadi04.data.DataAccess;
import dam2.etvmallorcadi04.dto.Allotjament;
import dam2.etvmallorcadi04.dto.Comentari;
import dam2.etvmallorcadi04.dto.Municipi;
import dam2.etvmallorcadi04.dto.Servei;
import java.awt.BorderLayout;
import jpanelimagen.JPanelImagen;

public class InfoPanel extends javax.swing.JPanel {

    private MainPage mainPage;
    private Allotjament allotjament;
    private DataAccess da;

    public InfoPanel(JPanel mainPage) {
        initComponents();
        this.mainPage = (MainPage) mainPage;
        da = new DataAccess();
        jPanelImagen = new JPanelImagen(da.getImagesAllotjament(1), 3000, pnlSlider.getWidth(), pnlSlider.getHeight());
        jPanelImagen.setBounds(0, 0, pnlSlider.getWidth(), pnlSlider.getHeight());
        pnlSlider.add(jPanelImagen, BorderLayout.CENTER);

    }

    // Setter para modificar el Allotjament
    public void setAllotjament(Allotjament allotjament) {
        this.allotjament = allotjament;
        setVisible(true);
        fillPanel();
    }

    // Metodo para rellenar infoPanel
    private void fillPanel() {
        txtName.setText(allotjament.getNom());
        txtAddress.setText(allotjament.getAdresa());
        showLocationItem();
        spnGuests.setValue(allotjament.getNumPersones());
        spnPriceNight.setValue(allotjament.getPreuPerNit());
        selectServices();
        txaDescription.setText(allotjament.getDescripcio());
        txaDescription.setCaretPosition(0); // Mostrar el contenido de txaDescription desde el principio
        showScore();
        showReviews();
        jPanelImagen.setImages(da.getImagesAllotjament(allotjament.getId()));

    }

    // Metodo para rellenar cmbLocation con los nombres de los Municipi
    private void fillLocationItems() {
        List<Municipi> municipis = da.getMunicipis();
        for (Municipi m : municipis) {
            cmbLocation.addItem(m.getNom());
        }
    }

    // Metodo para mostrar el nombre del Municipi del alojamiento seleccionado
    private void showLocationItem() {
        fillLocationItems();
        cmbLocation.setSelectedItem(allotjament.getMunicipi());
    }

    // Metodo para seleccionar los Servei activos del Allotjament
    private void selectServices() {
        List<Servei> services = da.getServeisAllotjament(allotjament.getId());
        resetChkBox();
        for (Servei s : services) {
            switch (s.getDescripcio()) {
                case "Piscina":
                    chkPool.setSelected(true);
                    break;
                case "Admet mascotes":
                    chkPets.setSelected(true);
                    break;
                case "Aire condicionat":
                    chkAC.setSelected(true);
                    break;
                case "Ascensor":
                    chkLift.setSelected(true);
                    break;
                case "Aparcament":
                    chkParking.setSelected(true);
                    break;
                case "Wifi":
                    chkWifi.setSelected(true);
                    break;
            }
        }
    }

    // Metodo para hacer un reset de los RadioButtons
    private void resetChkBox() {
        if (chkPool.isSelected()) {
            chkPool.setSelected(false);
        }
        if (chkPets.isSelected()) {
            chkPets.setSelected(false);
        }
        if (chkAC.isSelected()) {
            chkAC.setSelected(false);
        }
        if (chkLift.isSelected()) {
            chkLift.setSelected(false);
        }
        if (chkParking.isSelected()) {
            chkParking.setSelected(false);
        }
        if (chkWifi.isSelected()) {
            chkWifi.setSelected(false);
        }
    }

    // Metodo para mostrar el Score del Allotjament
    private void showScore() {
        String score = String.format("%.2f", da.getValoracioAllotjamentAvg(allotjament.getId()));
        if (!score.equals("0,00")) {
            txtScore.setText(score);
        } else {
            txtScore.setText("-");
        }
    }

    // Metodo para mostrar los Comentari del Allotjament
    protected void showReviews() {
        List<Comentari> comentaris = da.getComentaris(allotjament.getId());
        resetReviews();
        String data = txaReviews.getText().trim(); // Instruccion para comprobar si tiene contenido el txaReviews
        for (Comentari c : comentaris) {
            if (data == null || (!data.equals(""))) { // Primer Comentari
                txaReviews.setText(c.getDataihora() + " " + da.getUser(c.getIdUsuari()).getNom() + " " + da.getUser(c.getIdUsuari()).getLlinatges() + " said:\n" + c.getText() + "\n\n-----\n\n");
            } else { // Metodo para anaydir otros Comentari y no sobreescribir el escrito anteriormente
                txaReviews.append(c.getDataihora() + " " + da.getUser(c.getIdUsuari()).getNom() + " " + da.getUser(c.getIdUsuari()).getLlinatges() + " said:\n" + c.getText() + "\n\n-----\n\n");
            }
        }
        txaReviews.setCaretPosition(0); // Mostrar automaticamente desde el principio del contenido del txaReviews
    }

    // Metodo para hacer un reset de los datos contenidos en el txaReviews
    private void resetReviews() {
        txaReviews.setText("");
    }

    // Metodo para actualizar un Allotjament
    private Allotjament modifyAllotjament(Allotjament updatedAllotjament) {
        updatedAllotjament.setNom(txtName.getText());
        updatedAllotjament.setDescripcio(txaDescription.getText());
        updatedAllotjament.setNumPersones((int) spnGuests.getValue());
        updatedAllotjament.setAdresa(txtAddress.getText());
        updatedAllotjament.setMunicipi(String.valueOf(cmbLocation.getSelectedItem()));
        updatedAllotjament.setIdMunicipi(da.extractIdMunicipi(updatedAllotjament.getMunicipi()));
        updatedAllotjament.setPreuPerNit((float) spnPriceNight.getValue());

        return updatedAllotjament;
    }

    // Metodo para seleccionar los Servei actualizados
    private int[] selectedServeis() {
        int[] updatedServeis = new int[6];
        updatedServeis[0] = chkPool.isSelected() ? 1 : 0;
        updatedServeis[1] = chkPets.isSelected() ? 1 : 0;
        updatedServeis[2] = chkAC.isSelected() ? 1 : 0;
        updatedServeis[3] = chkLift.isSelected() ? 1 : 0;
        updatedServeis[4] = chkParking.isSelected() ? 1 : 0;
        updatedServeis[5] = chkWifi.isSelected() ? 1 : 0;

        return updatedServeis;
    }

    // Metodo para mostrar el JDialog para responder comentarios
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
        lblPhotos = new javax.swing.JLabel();
        lblScore = new javax.swing.JLabel();
        txtScore = new javax.swing.JTextField();
        lblReviews = new javax.swing.JLabel();
        scrReviews = new javax.swing.JScrollPane();
        txaReviews = new javax.swing.JTextArea();
        btnSave = new javax.swing.JButton();
        chkAuto = new javax.swing.JCheckBox();
        btnBack = new javax.swing.JButton();
        btnNext = new javax.swing.JButton();
        jScrollPane1 = new javax.swing.JScrollPane();
        txaPictureInfo = new javax.swing.JTextArea();
        btnReply = new javax.swing.JButton();
        pnlSlider = new javax.swing.JPanel();

        setBorder(javax.swing.BorderFactory.createMatteBorder(1, 1, 1, 1, new java.awt.Color(51, 51, 51)));
        setLayout(null);

        lblName.setText("Name:");
        add(lblName);
        lblName.setBounds(20, 20, 60, 30);
        add(txtName);
        txtName.setBounds(100, 20, 760, 30);

        lblAddress.setText("Address:");
        add(lblAddress);
        lblAddress.setBounds(20, 60, 60, 30);
        add(txtAddress);
        txtAddress.setBounds(100, 60, 760, 30);

        lblLocation.setText("Location:");
        add(lblLocation);
        lblLocation.setBounds(20, 100, 60, 30);

        add(cmbLocation);
        cmbLocation.setBounds(100, 100, 140, 30);

        lblGuests.setText("Guests:");
        add(lblGuests);
        lblGuests.setBounds(280, 100, 60, 30);
        add(spnGuests);
        spnGuests.setBounds(380, 100, 80, 30);

        lblPriceNight.setText("Price/Night:");
        add(lblPriceNight);
        lblPriceNight.setBounds(510, 100, 80, 30);

        spnPriceNight.setModel(new javax.swing.SpinnerNumberModel(0.0f, null, null, 0.01f));
        add(spnPriceNight);
        spnPriceNight.setBounds(630, 100, 80, 30);

        lblServices.setText("Services:");
        add(lblServices);
        lblServices.setBounds(20, 140, 80, 40);

        chkPool.setText("Swimming Pool");
        add(chkPool);
        chkPool.setBounds(100, 150, 130, 20);

        chkPets.setText("Pets Allowed");
        add(chkPets);
        chkPets.setBounds(280, 150, 110, 20);

        chkAC.setText("AC");
        add(chkAC);
        chkAC.setBounds(440, 150, 50, 20);

        chkLift.setText("Lift");
        add(chkLift);
        chkLift.setBounds(560, 150, 60, 20);

        chkParking.setText("Parking");
        add(chkParking);
        chkParking.setBounds(670, 150, 100, 20);

        chkWifi.setText("Wifi");
        add(chkWifi);
        chkWifi.setBounds(810, 150, 70, 20);

        lblDescription.setText("Description:");
        add(lblDescription);
        lblDescription.setBounds(20, 190, 80, 16);

        txaDescription.setColumns(20);
        txaDescription.setLineWrap(true);
        txaDescription.setRows(5);
        txaDescription.setWrapStyleWord(true);
        scrDescription.setViewportView(txaDescription);

        add(scrDescription);
        scrDescription.setBounds(100, 190, 760, 90);

        lblPhotos.setText("Photos:");
        add(lblPhotos);
        lblPhotos.setBounds(520, 290, 60, 16);

        lblScore.setText("Score:");
        add(lblScore);
        lblScore.setBounds(30, 600, 50, 30);

        txtScore.setEditable(false);
        txtScore.setHorizontalAlignment(javax.swing.JTextField.CENTER);
        add(txtScore);
        txtScore.setBounds(80, 600, 60, 30);

        lblReviews.setText("Reviews:");
        add(lblReviews);
        lblReviews.setBounds(30, 290, 80, 16);

        txaReviews.setEditable(false);
        txaReviews.setColumns(20);
        txaReviews.setLineWrap(true);
        txaReviews.setRows(5);
        txaReviews.setWrapStyleWord(true);
        scrReviews.setViewportView(txaReviews);

        add(scrReviews);
        scrReviews.setBounds(30, 310, 360, 280);

        btnSave.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Save.png"))); // NOI18N
        btnSave.setText("Save");
        btnSave.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnSaveActionPerformed(evt);
            }
        });
        add(btnSave);
        btnSave.setBounds(770, 700, 90, 30);

        chkAuto.setText("Auto");
        chkAuto.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                chkAutoActionPerformed(evt);
            }
        });
        add(chkAuto);
        chkAuto.setBounds(440, 310, 60, 20);

        btnBack.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Previous.png"))); // NOI18N
        btnBack.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnBackActionPerformed(evt);
            }
        });
        add(btnBack);
        btnBack.setBounds(440, 380, 50, 30);

        btnNext.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Next.png"))); // NOI18N
        btnNext.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnNextActionPerformed(evt);
            }
        });
        add(btnNext);
        btnNext.setBounds(440, 340, 50, 30);

        txaPictureInfo.setEditable(false);
        txaPictureInfo.setColumns(20);
        txaPictureInfo.setRows(5);
        jScrollPane1.setViewportView(txaPictureInfo);

        add(jScrollPane1);
        jScrollPane1.setBounds(520, 600, 330, 86);

        btnReply.setIcon(new javax.swing.ImageIcon(getClass().getResource("/images/Reply.png"))); // NOI18N
        btnReply.setText("Reply");
        add(btnReply);
        btnReply.setBounds(300, 600, 90, 30);

        pnlSlider.setBackground(new java.awt.Color(255, 51, 51));
        pnlSlider.setLayout(null);
        add(pnlSlider);
        pnlSlider.setBounds(520, 320, 330, 270);
    }// </editor-fold>//GEN-END:initComponents

    private void btnSaveActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnSaveActionPerformed
        Allotjament updatedAllotjament = modifyAllotjament(allotjament);
        da.updateAllojtament(updatedAllotjament);
        da.updateServeisAllotjament(updatedAllotjament.getId(), selectedServeis());
        // Actualizar el contenido de la tabla de Allotjaments en la pagina principal
        mainPage.fillTableAllotjaments();
    }//GEN-LAST:event_btnSaveActionPerformed

    private void chkAutoActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_chkAutoActionPerformed
        if (chkAuto.isSelected()) {
            jPanelImagen.autoSlider();
        } else {
            jPanelImagen.stopSlider();
        }
    }//GEN-LAST:event_chkAutoActionPerformed

    private void btnNextActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnNextActionPerformed
        jPanelImagen.nextImage();
        txaPictureInfo.setText(jPanelImagen.getFullInfo());// TODO add your handling code here:
        jPanelImagen.repaint();
    }//GEN-LAST:event_btnNextActionPerformed

    private void btnBackActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnBackActionPerformed
        jPanelImagen.previousImage();
        txaPictureInfo.setText(jPanelImagen.getFullInfo());
        jPanelImagen.repaint();
    }//GEN-LAST:event_btnBackActionPerformed

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnBack;
    private javax.swing.JButton btnNext;
    private javax.swing.JButton btnReply;
    private javax.swing.JButton btnSave;
    private javax.swing.JCheckBox chkAC;
    private javax.swing.JCheckBox chkAuto;
    private javax.swing.JCheckBox chkLift;
    private javax.swing.JCheckBox chkParking;
    private javax.swing.JCheckBox chkPets;
    private javax.swing.JCheckBox chkPool;
    private javax.swing.JCheckBox chkWifi;
    private javax.swing.JComboBox<String> cmbLocation;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JLabel lblAddress;
    private javax.swing.JLabel lblDescription;
    private javax.swing.JLabel lblGuests;
    private javax.swing.JLabel lblLocation;
    private javax.swing.JLabel lblName;
    private javax.swing.JLabel lblPhotos;
    private javax.swing.JLabel lblPriceNight;
    private javax.swing.JLabel lblReviews;
    private javax.swing.JLabel lblScore;
    private javax.swing.JLabel lblServices;
    private javax.swing.JPanel pnlSlider;
    private javax.swing.JScrollPane scrDescription;
    private javax.swing.JScrollPane scrReviews;
    private javax.swing.JSpinner spnGuests;
    private javax.swing.JSpinner spnPriceNight;
    private javax.swing.JTextArea txaDescription;
    private javax.swing.JTextArea txaPictureInfo;
    private javax.swing.JTextArea txaReviews;
    private javax.swing.JTextField txtAddress;
    private javax.swing.JTextField txtName;
    private javax.swing.JTextField txtScore;
    // End of variables declaration//GEN-END:variables
   private jpanelimagen.JPanelImagen jPanelImagen;
}
