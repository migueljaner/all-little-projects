package dam2.etvmallorcadi04.dto;

public class Allotjament {

    // Declaracion variables
    private int id;
    private String nom;
    private String descripcio;
    private int numPersones;
    private String adresa;
    private int idMunicipi;
    private String municipi;
    private int idPropietari;
    private boolean destacat;
    private float preuPerNit;

    // Getters y Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescripcio() {
        return descripcio;
    }

    public void setDescripcio(String descripcio) {
        this.descripcio = descripcio;
    }

    public int getNumPersones() {
        return numPersones;
    }

    public void setNumPersones(int numPersones) {
        this.numPersones = numPersones;
    }

    public String getAdresa() {
        return adresa;
    }

    public void setAdresa(String adresa) {
        this.adresa = adresa;
    }

    public int getIdMunicipi() {
        return idMunicipi;
    }

    public void setIdMunicipi(int idMunicipi) {
        this.idMunicipi = idMunicipi;
    }

    public String getMunicipi() {
        return municipi;
    }

    public void setMunicipi(String municipi) {
        this.municipi = municipi;
    }

    public int getIdPropietari() {
        return idPropietari;
    }

    public void setIdPropietari(int idPropietari) {
        this.idPropietari = idPropietari;
    }

    public boolean isDestacat() {
        return destacat;
    }

    public void setDestacat(boolean destacat) {
        this.destacat = destacat;
    }

    public float getPreuPerNit() {
        return preuPerNit;
    }

    public void setPreuPerNit(float preuPerNit) {
        this.preuPerNit = preuPerNit;
    }

}
