package dam2.etvmallorcadi04.panels;

import java.util.ArrayList;
import java.util.List;
import javax.swing.RowSorter.SortKey;
import javax.swing.SortOrder;
import javax.swing.table.TableRowSorter;
import dam2.etvmallorcadi04.Main;
import dam2.etvmallorcadi04.data.DataAccess;
import dam2.etvmallorcadi04.dto.Allotjament;
import dam2.etvmallorcadi04.dto.Usuari;
import dam2.etvmallorcadi04.models.AllotjamentsTableModel;

public class MainPage extends javax.swing.JPanel {

    private Main jframeMain;
    private DataAccess da;
    private Usuari user;
    private InfoPanel infoPanel;
    private TableRowSorter<AllotjamentsTableModel> sorter;

    public MainPage(Main jframeMain, Usuari user) {
        initComponents();
        this.jframeMain = jframeMain;
        this.user = user;
        da = new DataAccess();
        lblWelcome.setText("Bienvenido " + user.getNom());
        fillTableAllotjaments();
        showInfoPanel();
    }

    // Metodo que rellena la tabla de Allotjament del Usuari
    public void fillTableAllotjaments() {

        // Establecemos el modelo de la tabla y le pasamos la lista de Allotjaments del user seleccionado
        AllotjamentsTableModel atm = new AllotjamentsTableModel(da.getAllotjaments(user.getId()));
        tblAllotjaments.setModel(atm);

        // Aplicamos el objeto sorter para filtrar/ordenar la tabla
        sorter = new TableRowSorter<>(atm);
        tblAllotjaments.setRowSorter(sorter);

        // Ordenamos por defecto la columna de Name
        List<SortKey> sortKey = new ArrayList<>(); // Declaramos e inicializamos una List de SortKey
        sortKey.add(new SortKey(0, SortOrder.ASCENDING)); // Anyadimos un objeto SortKey indicando la columna por defecto y el orden
        sorter.setSortKeys(sortKey); // Transmitimos al objeto sorter dicho orden
    }

    // Metodo para refrescar el nombre al modificarlo
    public void refreshName(Usuari user) {
        lblWelcome.setText("WELCOME " + user.getNom().toUpperCase());
    }

    // Metodo para mostrar el JPanel con la informacion de los Allotjaments
    private void showInfoPanel() {
        infoPanel = new InfoPanel(this);
        add(infoPanel);
        infoPanel.setBounds(750, 25, 900, 750);
        infoPanel.setVisible(false);
    }

    // Metodo para ocultar la tabla
    public void hideTable() {
        scrAllotjaments.setVisible(false);
    }

    // Metodo para mostrar la tabla
    public void showTable() {
        scrAllotjaments.setVisible(true);
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lblWelcome = new javax.swing.JLabel();
        scrAllotjaments = new javax.swing.JScrollPane();
        tblAllotjaments = new javax.swing.JTable();

        setLayout(null);

        lblWelcome.setFont(new java.awt.Font("Brush Script MT", 1, 28)); // NOI18N
        lblWelcome.setForeground(new java.awt.Color(0, 0, 0));
        add(lblWelcome);
        lblWelcome.setBounds(29, 27, 650, 50);

        tblAllotjaments.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null},
                {null, null, null, null}
            },
            new String [] {
                "Title 1", "Title 2", "Title 3", "Title 4"
            }
        ));
        tblAllotjaments.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                tblAllotjamentsMouseClicked(evt);
            }
        });
        scrAllotjaments.setViewportView(tblAllotjaments);

        add(scrAllotjaments);
        scrAllotjaments.setBounds(30, 150, 660, 500);
    }// </editor-fold>//GEN-END:initComponents

    private void tblAllotjamentsMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_tblAllotjamentsMouseClicked
        // Sincronizacion de tablas entre la de BD y la "creada" tras aplicar el orden
        int seleccionado = tblAllotjaments.convertRowIndexToModel(tblAllotjaments.getSelectedRow());
        // Pasamos el objeto Allotjament a infoPanel
        int idAllotjament = da.getAllotjaments(user.getId()).get(seleccionado).getId();
        Allotjament allotjamentSelected = da.getAllotjament(idAllotjament);
        infoPanel.setAllotjament(allotjamentSelected);
    }//GEN-LAST:event_tblAllotjamentsMouseClicked


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel lblWelcome;
    private javax.swing.JScrollPane scrAllotjaments;
    private javax.swing.JTable tblAllotjaments;
    // End of variables declaration//GEN-END:variables
}
