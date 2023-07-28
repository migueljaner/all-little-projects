package dam2.etvmallorcadi04.dto;

public class Imatge {

    // Declaracion variables
    private int id;
    private String imatge; // OJO
    private String nomFitxerImatge;
    private String tipusMimeFitxerImatge;
    private String descripcio;

    // Getters y Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getImatge() {
        return imatge;
    }

    public void setImatge(String imatge) {
        this.imatge = imatge;
    }

    public String getNomFitxerImatge() {
        return nomFitxerImatge;
    }

    public void setNomFitxerImatge(String nomFitxerImatge) {
        this.nomFitxerImatge = nomFitxerImatge;
    }

    public String getTipusMimeFitxerImatge() {
        return tipusMimeFitxerImatge;
    }

    public void setTipusMimeFitxerImatge(String tipusMimeFitxerImatge) {
        this.tipusMimeFitxerImatge = tipusMimeFitxerImatge;
    }

    public String getDescripcio() {
        return descripcio;
    }

    public void setDescripcio(String descripcio) {
        this.descripcio = descripcio;
    }

}
