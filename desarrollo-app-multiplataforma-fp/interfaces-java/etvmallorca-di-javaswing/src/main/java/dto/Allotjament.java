/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package dto;

/**
 *
 * @author Miquel
 */
public class Allotjament {

    private int Id;
    private String Nom;
    private String Descripcio;
    private String Adresa;
    private String Municipi;
    private int Num_persones;
    private float Preu_per_nit;
    private int Id_Municipi;
    private int Id_Propietari;

    public Allotjament() {
    }

    public int getId() {
        return Id;
    }

    public void setId(int Id) {
        this.Id = Id;
    }

    public String getNom() {
        return Nom;
    }

    public void setNom(String Nom) {
        this.Nom = Nom;
    }

    public String getDescripcio() {
        return Descripcio;
    }

    public void setDescripcio(String Descripcio) {
        this.Descripcio = Descripcio;
    }

    public String getAdresa() {
        return Adresa;
    }

    public void setAdresa(String Adresa) {
        this.Adresa = Adresa;
    }

    public String getMunicipi() {
        return Municipi;
    }

    public void setMunicipi(String Municipi) {
        this.Municipi = Municipi;
    }

    public int getNum_persones() {
        return Num_persones;
    }

    public void setNum_persones(int Num_persones) {
        this.Num_persones = Num_persones;
    }

    public float getPreu_per_nit() {
        return Preu_per_nit;
    }

    public void setPreu_per_nit(float Preu_Per_Nit) {
        this.Preu_per_nit = Preu_Per_Nit;
    }

    public int getId_municipi() {
        return this.Id_Municipi;
    }

    public int getId_propietari() {
        return this.Id_Propietari;
    }

    public void setId_Municipi(int Id_Municipi) {
        this.Id_Municipi = Id_Municipi;
    }

    public void setId_Propietari(int Id_Propietari) {
        this.Id_Propietari = Id_Propietari;
    }

    @Override
    public String toString() {
        return "Id: " + Id + " Nombre: " + Nom; // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/OverriddenMethodBody
    }

}
