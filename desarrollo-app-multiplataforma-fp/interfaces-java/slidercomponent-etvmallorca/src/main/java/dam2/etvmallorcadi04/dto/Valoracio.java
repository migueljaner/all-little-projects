package dam2.etvmallorcadi04.dto;

public class Valoracio {

    // Declaracion variables
    private int idUsuari;
    private int idAllotjament;
    private int numEstrelles;
    private String dataihora;

    // Getters y Setters
    public int getIdUsuari() {
        return idUsuari;
    }

    public void setIdUsuari(int idUsuari) {
        this.idUsuari = idUsuari;
    }

    public int getIdAllotjament() {
        return idAllotjament;
    }

    public void setIdAllotjament(int idAllotjament) {
        this.idAllotjament = idAllotjament;
    }

    public int getNumEstrelles() {
        return numEstrelles;
    }

    public void setNumEstrelles(int numEstrelles) {
        this.numEstrelles = numEstrelles;
    }

    public String getDataihora() {
        return dataihora;
    }

    public void setDataihora(String dataihora) {
        this.dataihora = dataihora;
    }

}
