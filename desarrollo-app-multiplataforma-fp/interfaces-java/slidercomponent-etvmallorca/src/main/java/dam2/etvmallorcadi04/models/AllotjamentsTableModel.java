package dam2.etvmallorcadi04.models;

import java.util.List;
import javax.swing.table.AbstractTableModel;
import dam2.etvmallorcadi04.dto.Allotjament;

public class AllotjamentsTableModel extends AbstractTableModel {

    // Atributos
    private List<Allotjament> listAllotjaments;
    private String[] columnas = {"Name", "Address", "Place"};

    // Constructor
    public AllotjamentsTableModel(List<Allotjament> listAllotjaments) {
        this.listAllotjaments = listAllotjaments;
    }

    @Override
    // Devuelve el numero de filas totales
    public int getRowCount() {
        return listAllotjaments.size();
    }

    @Override
    // Devuelve el numero de columnas totales
    public int getColumnCount() {
        return columnas.length;
    }

    @Override
    // Devuelve el contenido de la celda dicha por los parametros
    public Object getValueAt(int rowIndex, int columnIndex) {
        switch (columnIndex) {
            case 0: // Correspondiente a la columna Name
                return listAllotjaments.get(rowIndex).getNom();
            case 1: // Correspondiente a la columna Address
                return listAllotjaments.get(rowIndex).getAdresa();
            case 2: // Correspondiente a la columna Place
                return listAllotjaments.get(rowIndex).getMunicipi();
        }
        return null; // En teoria, nunca llega aqui
    }

    @Override
    // Devuelve el nombre de la columna especificada
    public String getColumnName(int column) {
        return columnas[column];
    }

}
