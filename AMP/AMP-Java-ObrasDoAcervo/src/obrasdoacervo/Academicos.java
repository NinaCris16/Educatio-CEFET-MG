/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package obrasdoacervo;

/**
 *
 * @author Aluno
 */
public class Academicos extends Obras {
    String programa; 

    public Academicos(String programa,int idObra, int idCampi, String nome, String tipo, String local, String ano, String editora, String paginas) {
        super(idObra, idCampi, nome, tipo, local, ano, editora, paginas);
        this.programa = programa;
    }



    public String getPrograma() {
        return programa;
    }

    public void setPrograma(String programa) {
        this.programa = programa;
    }
}