package generatorpdf;

import com.itextpdf.text.Chapter;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import com.itextpdf.text.Font;
import com.itextpdf.text.FontFactory;
import com.itextpdf.text.Image;
import com.itextpdf.text.Rectangle;
import com.itextpdf.text.BaseColor;
import com.itextpdf.text.List;
import com.itextpdf.text.ListItem;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.Section;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfReader;
import com.itextpdf.text.pdf.PdfStamper;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.sql.Connection;
import java.sql.SQLException;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.Map;
import utl.Conexao;
import utl.HeaderAndFooter;
import utl.ManipulatePDF;
import utl.Chars;

public class GeneratorPDF {
    public static final String ARIAL = "fonts\\Arial\\arial.ttf";
    public static Paragraph titulo = new Paragraph();
    public static Paragraph paragrafo = new Paragraph();
    public static Document document;
    public static String nameDocument;
    public static HeaderAndFooter event;
    public static ArrayList<Chapter> capitulos = null;
    private static int idDoc;
    private static int idEquipe;
    private static String root;
    private static boolean finalizado;
    public static final String dirimg = "C:\\appserv\\www\\fasttcc\\uploads\\images\\";

    public static void formatar() 
    {
        /*------------------------------- FONTES --------------------------------- */
        // Registrando fonte
        FontFactory.register(ARIAL,"Arial");
        
        Font fonteNormal = FontFactory.getFont("Arial","Cp1252",12f);
        //Font fonteCitacaoIndireta = FontFactory.getFont("Arial","Cp1252",10f);
        Font fonteCitacaoDiretaLonga = FontFactory.getFont("Arial","Cp1252",10f);
        Font fonteLegImg = FontFactory.getFont("Arial","Cp1252",10f);
        
        /************** TÍTULOS **************/
        Font tituloNegrito = FontFactory.getFont("Arial","Cp1252",12f,Font.BOLD);
        Font tituloNegritoCapa = FontFactory.getFont("Arial","Cp1252",14f,Font.BOLD);
        Font tituloItalico = FontFactory.getFont("Arial","Cp1252",12f,Font.ITALIC);
        Font tituloNormal = FontFactory.getFont("Arial","Cp1252",12f);
        
        titulo.setFont(tituloNegrito);
        /************** ***** **************/
        
        /************* PARÁGRAFOS ************/
        paragrafo.setFont(fonteNormal);
        paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
        paragrafo.setFirstLineIndent(20.f);
        paragrafo.setLeading(20.50f);
        /************************************/
        
        /************ CAPÍTULOS ***********/
        capitulos = new ArrayList<>();
        Chapter capitulo = null;
        Section secao = null;
        Section subsecao;
        /********************************/
        /*--------------------------------------------------------------------- */
        
        String[] objetivos_esp = new String[10];
        String[] conclusoes = new String[10];
        String[] materiais = new String[10];
        
        Connection conexao = Conexao.conectar();
        try {
            /************ FAZENDO CONTAGEM DE ELEMENTOS DO SUMÁRIO ****************/
            int countElements = 9;
            PreparedStatement query = conexao.prepareStatement("SELECT COUNT(titulo) AS quant FROM referencial_teorico WHERE iddocumento = ?");
            query.setInt(1,idDoc);
            ResultSet res = query.executeQuery();
            if (res.next()) {
                countElements += res.getInt("quant");
            }
            
            query = conexao.prepareStatement("SELECT * FROM documentos WHERE id = ?");
            query.setInt(1,idDoc);
            
            res = query.executeQuery();
            if (res.next()) {
                for (int i = 1; i <= 10; i++) {
                    if (res.getString("objetivo_esp"+i) != null) {
                        countElements++;
                    }
                    
                    if(res.getString("material"+i) != null) {
                        countElements++;
                    }
                }
            }
            
            nameDocument = decodificar(res.getString("titulo"));
            
            query = conexao.prepareStatement("SELECT COUNT(nomeItem) AS quant FROM itens_metodologia WHERE idDocumento = ?");
            query.setInt(1,idDoc);
            res = query.executeQuery();
            if (res.next()) {
                countElements += res.getInt("quant");
            }
            
            query = conexao.prepareStatement("SELECT COUNT(nome) AS quant FROM metodologia WHERE iddocumento = ? AND idreference = 0");
            query.setInt(1,idDoc);
            res = query.executeQuery();
            if(res.next()) {
                countElements += res.getInt("quant");
            }
            
            query.close();
            res.close();
            /*****************************************************************************/
            
            PreparedStatement ps = conexao.prepareStatement("SELECT * FROM documentos WHERE id = ?");
            ps.setInt(1,idDoc);
            ResultSet rs = ps.executeQuery();
            
            int contTitulos = 1;
            if (rs.next())
            {
                try {
                    document = new Document(PageSize.A4);
                    document.setMargins(60f, 40f, 60f, 40f);
                   
                    // Criação do documento PDF
                    PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(root + "\\documento.pdf"));
                    document.open();
                    /************************** CAPA **************************/
                    // formatação da capa
                    Paragraph capa = new Paragraph();
                    capa.setFont(tituloNegritoCapa); // fonte
                    capa.setAlignment(Paragraph.ALIGN_CENTER); // alinhamento
                    capa.setLeading(20.50f); // espaçamento
                    capa.add(decodificar(rs.getString("instituicao")).toUpperCase() + "\n"); // adicionar nome da instituição de ensino
                    capa.add(decodificar(rs.getString("curso")).toUpperCase() + "\n\n"); // adicionar curso
                   
                    // Conexão com Banco de Dados para resgate de informações
                    PreparedStatement aux = conexao.prepareStatement("SELECT nome FROM equipes AS e INNER JOIN usuarios AS u "
                        + "ON e.id = u.idequipe INNER JOIN documentos AS d ON d.idequipe = e.id WHERE e.id = ? ORDER BY nome ASC");
                    aux.setInt(1, idEquipe);
                    ResultSet rsAux = aux.executeQuery(); // as informações são guardadas aqui
                    
                    // adicionar os autores na capa
                    while(rsAux.next()) {
                        capa.add(decodificar(rsAux.getString("nome")).toUpperCase() + "\n");
                    }
                   
                    document.add(capa); // adicionar as informações no documento
                    capa.clear(); // limpar parágrafo

                    for (int i = 1; i <= 12; i++) {
                        document.add(Chunk.NEWLINE);
                    }
                    int tamSub = rs.getString("subtitulo").length();
                    if (rs.getString("subtitulo") != null && !rs.getString("subtitulo").equals("")) 
                    {
                        capa.add(decodificar(rs.getString("titulo")).toUpperCase() + "\n");
                        capa.add(decodificar(rs.getString("subtitulo")).toUpperCase() + "\n");
                    } else {
                        capa.add(decodificar(rs.getString("titulo")).toUpperCase() + "\n");
                    }
                    
                    document.add(capa);
                    capa.clear();

                    // tamanho do subtitulo dividido por 84, o resultado representa uma linha
                    int range = (tamSub > 47) ? 12 : 13;
                    for (int i = 0; i < range; i++) {
                        document.add(Chunk.NEWLINE);
                    }
                    
                    capa.add(decodificar(rs.getString("cidade")).toUpperCase() + "\n");
                    capa.add(rs.getString("ano") + "\n");
                    document.add(capa);
                    
                    document.newPage();
                    
                    /************************** FOLHA DE ROSTO **************************/
                    Paragraph folhaRosto = new Paragraph();
                    folhaRosto.setFont(tituloNegritoCapa); // fonte
                    folhaRosto.setAlignment(Paragraph.ALIGN_CENTER);
                    folhaRosto.setLeading(20.50f); // espaçamento
                    folhaRosto.add(decodificar(rs.getString("instituicao")).toUpperCase() + "\n"); // adicionar nome da instituição de ensino
                    folhaRosto.add(decodificar(rs.getString("curso")).toUpperCase() + "\n\n");
                    
                    rsAux.beforeFirst();
                    while(rsAux.next()) {
                        folhaRosto.add(decodificar(rsAux.getString("nome")).toUpperCase() + "\n");
                    }
                    
                    document.add(folhaRosto);
                    folhaRosto.clear();
                    
                    for (int i = 1; i <= 12; i++) {
                        document.add(Chunk.NEWLINE);
                    }
                    
                    if (rs.getString("subtitulo") != null && !rs.getString("subtitulo").equals("")) 
                    {
                        folhaRosto.add(decodificar(rs.getString("titulo")).toUpperCase() + "\n");
                        folhaRosto.add(decodificar(rs.getString("subtitulo")).toUpperCase() + "\n");
                    } else {
                        folhaRosto.add(decodificar(rs.getString("titulo")).toUpperCase() + "\n");
                    }
                                        
                    document.add(folhaRosto);
                    folhaRosto.clear();
                    
                    document.add(Chunk.NEWLINE);
                    document.add(Chunk.NEWLINE);
                    
                    Font fonteTxtApresentacao = FontFactory.getFont("Arial","Cp1252",10f);
                    folhaRosto.setFont(fonteTxtApresentacao);
                    folhaRosto.setLeading(10);
                    folhaRosto.setIndentationLeft(250);
                    folhaRosto.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    
                    folhaRosto.add("Trabalho de Conclusão de Curso apresentado ao " + decodificar(rs.getString("curso")) + ", da ETEC Prof.ª Ilza Nascimento Pintus, como requisito à obtenção do certificado de conclusão de curso.");
                    document.add(folhaRosto);
                    document.add(Chunk.NEWLINE);
                    folhaRosto.clear();
                    
                    aux = conexao.prepareStatement("SELECT u.nome FROM equipes AS e INNER JOIN usuarios AS u ON e.idorientador = u.id WHERE e.id = ?");
                    aux.setInt(1,idEquipe);
                    rsAux = aux.executeQuery();
                    if(rsAux.next()) {
                        folhaRosto.add("Orientador: Prof. " + decodificar(rsAux.getString("nome")));
                        document.add(folhaRosto);
                    }
                    
                    range = (tamSub > 47) ? 14 : 16;
                    for(int i = 0; i < range; i++) {
                        document.add(Chunk.NEWLINE);
                    }
                    
                    folhaRosto.clear();
                    folhaRosto.setAlignment(Paragraph.ALIGN_CENTER);
                    folhaRosto.setFont(tituloNegritoCapa);
                    folhaRosto.setLeading(20.50f);
                    folhaRosto.setIndentationLeft(0);
                    
                    folhaRosto.add(decodificar(rs.getString("cidade")).toUpperCase() + "\n");
                    folhaRosto.add(rs.getString("ano") + "\n");
                    document.add(folhaRosto);
                    
                    document.newPage();
                    /********************************************************************/
                     // encerrar conexões
                    rsAux.close();
                    aux.close();
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* CORPO DO DOCUMENTO *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
                    // Sumário GitHub -> https://gist.github.com/kencharos/2001340
                    
                    titulo.clear();
                    titulo.setFont(tituloNegrito);
                    titulo.setAlignment(Paragraph.ALIGN_CENTER);
                    titulo.add("RESUMO");
                    document.add(titulo);
                    document.add(Chunk.NEWLINE);
                    
                    paragrafo.clear();
                    paragrafo.setFont(fonteNormal);
                    paragrafo.setFirstLineIndent(0);
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    paragrafo.add(decodificar(rs.getString("resumo_port")));
                    document.add(paragrafo);
                    document.add(Chunk.NEWLINE);
                    
                    PdfPTable tablePalavras = new PdfPTable(2);
                    
                    Paragraph bold = new Paragraph("Palavras-chave: ",tituloNegrito);
                    bold.setAlignment(Paragraph.ALIGN_RIGHT);
                    
                    PdfPCell negrito = new PdfPCell();
                    negrito.setHorizontalAlignment(Element.ALIGN_RIGHT);
                    negrito.setBorder(Rectangle.NO_BORDER);
                    negrito.addElement(bold);
                    
                    PdfPCell palavras  = new PdfPCell();
                    palavras.setHorizontalAlignment(Element.ALIGN_LEFT);
                    palavras.setBorder(Rectangle.NO_BORDER);
                    palavras.addElement(new Chunk(decodificar(rs.getString("palavra_chave1") + ", " + rs.getString("palavra_chave2") + ", " + rs.getString("palavra_chave3"))));
                    
                    tablePalavras.addCell(negrito);
                    tablePalavras.addCell(palavras);
                    
                    document.add(tablePalavras);
                            
                    document.newPage();
                    
                    titulo.clear();
                    titulo.add("ABSTRACT");
                    document.add(titulo);
                    document.add(Chunk.NEWLINE);
                    
                    paragrafo.clear();
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    paragrafo.add(decodificar(rs.getString("resumo_ing")));
                    document.add(paragrafo);
                    document.add(Chunk.NEWLINE);
                    
                    PdfPTable tableKeyword = new PdfPTable(2);
                    
                    bold.clear();
                    bold.add("Keywords: ");
                    bold.setAlignment(Paragraph.ALIGN_RIGHT);
                    
                    PdfPCell negrito2 = new PdfPCell();
                    negrito2.setHorizontalAlignment(Element.ALIGN_RIGHT);
                    negrito2.setBorder(Rectangle.NO_BORDER);
                    negrito2.addElement(bold);
                    
                    PdfPCell keywords = new PdfPCell();
                    keywords.setHorizontalAlignment(Element.ALIGN_LEFT);
                    keywords.setBorder(Rectangle.NO_BORDER);
                    keywords.addElement(new Chunk(decodificar(rs.getString("keyword1") + ", " + rs.getString("keyword2") + ", " + rs.getString("keyword3"))));
                    
                    tableKeyword.addCell(negrito2);
                    tableKeyword.addCell(keywords);
                    
                    document.add(tableKeyword);
                    
                    event = new HeaderAndFooter();
                    event.setPagina((countElements > 39)? 7 : 6);
                    writer.setPageEvent(event);
                    
                    document.newPage();
                    
                    /************************** INTRODUÇÃO **************************/
                    String[] introducoes = new String[]{
                        rs.getString("introducao_tema"),rs.getString("introducao_historico"),rs.getString("introducao_evolucao"),
                        rs.getString("introducao_problema"),rs.getString("introducao_solucao")
                    };
                    
                    resetarTitulo(tituloNegrito, contTitulos + " INTRODUÇÃO",0);
                    titulo.setFont(tituloNormal);
                    
                    capitulo = transformarCap(capitulo,"INTRODUÇÃO",1);
                    
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    paragrafo.setIndentationLeft(0);
                    paragrafo.setFirstLineIndent(20.f);
                    for (String introducao : introducoes) 
                    {
                        resetarParagrafo(null,decodificar(introducao));
                    }
                    capitulos.add(capitulo);
                    
                    document.newPage();
                    
                    contTitulos++;
                    
                    /************************** OBJETIVOS **************************/
                    resetarTitulo(tituloNegrito,contTitulos + " OBJETIVOS",0);
                    
                    resetarTitulo(tituloNormal,contTitulos + ".1 OBJETIVO GERAL",0);
                    
                    resetarParagrafo(null,decodificar(rs.getString("objetivo_geral")));
                    
                    document.add(Chunk.NEWLINE);
                    
                    resetarTitulo(tituloNormal,contTitulos + ".2 OBJETIVOS ESPECÍFICOS",0);
                    capitulo = transformarCap(capitulo, "OBJETIVOS", contTitulos);
                    secao = transformarSec(secao,capitulo,"OBJETIVO GERAL");
                    indentar(secao,10);
                    secao = transformarSec(secao,capitulo,"OBJETIVOS ESPECÍFICOS");
                    indentar(secao,10);
                    
                    capitulos.add(capitulo);
                    
                    contTitulos++;
                    
                    List listaObjetivos = new List(List.UNORDERED);
                    ListItem objetivo;
                    listaObjetivos.setIndentationLeft(20.f);
                    
                    int ultimo = 0;
                    for (int i = 1; i <= 10; i++) 
                    {
                        if (rs.getString("objetivo_esp" + i) != null && !rs.getString("objetivo_esp" + i).isEmpty()) 
                        {
                            objetivos_esp[i-1] = decodificar(rs.getString("objetivo_esp" + i));
                            conclusoes[i-1] = decodificar(rs.getString("conc" + i));
                            ultimo = i;
                        }
                        if (rs.getString("material" + i) != null && !rs.getString("material" + i).isEmpty()) 
                        {
                            materiais[i-1] = decodificar(rs.getString("material" + i));
                            ultimo = i;
                        }
                    }
                    
                    for (int i = 1; i <= 10; i++) 
                    {
                        if (rs.getString("objetivo_esp"+i) != null && !rs.getString("objetivo_esp" + i).isEmpty()) 
                        {
                            if (i == ultimo)
                                objetivo = new ListItem(objetivos_esp[i-1] + ".");
                            else
                                objetivo = new ListItem(objetivos_esp[i-1] + ";");

                            objetivo.setAlignment(Element.ALIGN_JUSTIFIED);
                            listaObjetivos.add(objetivo);
                        }
                    }
                    document.add(listaObjetivos);
                    
                    /**************************************************************/
                    
                    document.newPage();
                    
                    /************************** REFERENCIAL TEÓRICO **************************/
                    resetarTitulo(tituloNegrito,contTitulos + " REFERENCIAL TEÓRICO",0);
                    
                    capitulo = transformarCap(capitulo, "REFERENCIAL TEÓRICO", contTitulos);
                    
                    ps = conexao.prepareStatement("SELECT * FROM referencial_teorico WHERE iddocumento = ?");
                    ps.setInt(1,idDoc);
                    
                    ResultSet rs2 = ps.executeQuery();
                    
                    int contRef = 1;
                    while (rs2.next()) 
                    {
                        resetarTitulo(tituloNormal, contTitulos + "." + contRef + " " + decodificar(rs2.getString("titulo")),0);
                        
                        contRef++;
                        paragrafo.setFirstLineIndent(20.f);          
                        if (rs2.getInt("tipoCitacao") == 1) 
                        {
                            paragrafo.setIndentationLeft(0);
                            paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                            paragrafo.setLeading(20.50f);
                            resetarParagrafo(fonteNormal, decodificar(rs2.getString("citacaoIndireta") + " (" + rs2.getString("refCitacao") + ")."));
                        } 
                        else if(rs2.getInt("tipoCitacao") == 0)
                        {
                            float linhas = rs2.getString("citacaoOriginal").length() / 82;
                            float recuo = (linhas > 2.79)? 100 : 0;
                            
                            paragrafo.setIndentationLeft(recuo);
                            
                            if(linhas > 2.79)
                            {
                                paragrafo.setFirstLineIndent(0);
                                paragrafo.setLeading(15.00f);
                            }
                            else
                            {
                                paragrafo.setFirstLineIndent(20.f);
                                paragrafo.setLeading(20.50f);
                            }
                            paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                            resetarParagrafo((linhas > 2.79) ? fonteCitacaoDiretaLonga : fonteNormal, decodificar(rs2.getString("citacaoOriginal")) + " (" + rs2.getString("refCitacao") + ").");
                        }
                        document.add(Chunk.NEWLINE);
                        
                        secao = transformarSec(secao,capitulo,decodificar(rs2.getString("titulo")));
                        indentar(secao,10);
                    }
                    capitulos.add(capitulo);
                    /**************************************************************/
                    
                    document.newPage();
                    
                    contTitulos++;
                    
                    paragrafo.setIndentationLeft(0);
                    paragrafo.setLeading(20.50f);
                    /************************** METODOLOGIA **************************/
                    resetarTitulo(tituloNegrito, contTitulos + " METODOLOGIA",0);
                    
                    /*------- Configurações Imagens -------*/
                    int contImgs = 1;
                    Chunk legenda;
                    Chunk fonte;
                    /*-------------------------------------*/
                    /*--------- Configurações itens -------*/
                    int contItemTitulo = 1;
                    int contItem;
                    /*-------------------------------------*/
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    
                    int idTopico;
                    capitulo = transformarCap(capitulo,"METODOLOGIA",contTitulos);
                    
                    PreparedStatement ps2 = conexao.prepareStatement("SELECT * FROM metodologia WHERE idDocumento = ? AND idreference = 0");
                    ps2.setInt(1,idDoc);
                    ResultSet rsMet = ps2.executeQuery();
                    while(rsMet.next())
                    {
                        idTopico = rsMet.getInt("id");
                        resetarTitulo(tituloNormal,contTitulos + "." + contItemTitulo + " " + Chars.utf8_decode(rsMet.getString("nome")).toUpperCase(),0);
                        
                        if (rsMet.getString("texto") != null && !rsMet.getString("texto").isEmpty()) 
                        {
                            paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                            paragrafo.setFirstLineIndent(20.f);
                            resetarParagrafo(fonteNormal, Chars.utf8_decode(rsMet.getString("texto")));
                            document.add(Chunk.NEWLINE);
                        }
                        
                        if(rsMet.getString("img_texto") != null && !rsMet.getString("img_texto").isEmpty())
                        {
                            try {
                                Image imagemMet = Image.getInstance(dirimg + rsMet.getString("img_texto"));
                                
                                setEscala(imagemMet);
                                imagemMet.setAlignment(Image.ALIGN_CENTER);
                                imagemMet.setBorder(Rectangle.BOX);
                                imagemMet.setBorderWidth(1);
                                imagemMet.setBorderColor(BaseColor.BLACK);
                                document.newPage();
                                document.add(imagemMet);
                                
                                legenda = new Chunk("Figura " + contImgs + " - " + Chars.utf8_decode(rsMet.getString("nome_img_texto"))); 
                                
                                paragrafo.setIndentationLeft(0);
                                paragrafo.setAlignment(Paragraph.ALIGN_CENTER);
                                resetarParagrafo(fonteLegImg,legenda.toString());
                                String strFonte = Chars.utf8_decode(rsMet.getString("fonte_img_texto"));
                                
                                if(!strFonte.equals("Autoria própria")) {
                                    fonte = new Chunk("Fonte: " + strFonte);
                                    resetarParagrafo(fonteLegImg,fonte.toString());
                                }
                                document.add(Chunk.NEWLINE);
                                
                                contImgs++;
                            } catch (IOException e) {
                                System.out.println("Erro na imagem ["+e.getMessage()+"]");
                            }
                        }
                        if(rsMet.getString("img_resultado") != null && !rsMet.getString("img_resultado").isEmpty())
                        {
                            try {
                                Image imagemMet = Image.getInstance(dirimg + rsMet.getString("img_resultado"));
                                
                                setEscala(imagemMet);
                                imagemMet.setAlignment(Image.ALIGN_CENTER);
                                imagemMet.setBorder(Rectangle.BOX);
                                imagemMet.setBorderWidth(1);
                                imagemMet.setBorderColor(BaseColor.BLACK);
                                document.newPage();
                                document.add(imagemMet);
                                
                                legenda = new Chunk("Figura " + contImgs + " - " + Chars.utf8_decode(rsMet.getString("nome_img_resultado"))); 
                                
                                paragrafo.setIndentationLeft(0);
                                paragrafo.setAlignment(Paragraph.ALIGN_CENTER);
                                resetarParagrafo(fonteLegImg,legenda.toString());
                                String strFonte = Chars.utf8_decode(rsMet.getString("fonte_img_resultado"));
                                
                                if(!strFonte.equals("Autoria própria")) {
                                    fonte = new Chunk("Fonte: " + strFonte);
                                    resetarParagrafo(fonteLegImg,fonte.toString());
                                }
                                document.add(Chunk.NEWLINE);
                                
                                contImgs++;
                            } catch (IOException e) {
                                System.out.println("Erro na imagem ["+e.getMessage()+"]");
                            }
                        }
                        
                        secao = transformarSec(secao,capitulo,Chars.utf8_decode(rsMet.getString("nome")));
                        indentar(secao,10);
                        
                        PreparedStatement psRes = conexao.prepareStatement("SELECT * FROM metodologia WHERE idreference = ?");
                        psRes.setInt(1,idTopico);
                        ResultSet rsResMet = psRes.executeQuery();
                        
                        contItem = 1;
                        while(rsResMet.next())
                        {
                            resetarTitulo(tituloNegrito,contTitulos + "." + contItemTitulo + "." + contItem + " " + Chars.utf8_decode(rsResMet.getString("nome")),0);
                        
                            if(rsResMet.getString("texto") != null && !rsResMet.getString("texto").isEmpty())
                            {
                                paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                                paragrafo.setFirstLineIndent(20.f);
                                resetarParagrafo(fonteNormal,Chars.utf8_decode(rsResMet.getString("texto")));
                                document.add(Chunk.NEWLINE);
                            }
                            
                            if(rsResMet.getString("img_texto") != null && !rsResMet.getString("img_texto").isEmpty())
                            {
                                try {
                                    Image imagemRes = Image.getInstance(dirimg + rsResMet.getString("img_texto"));

                                    setEscala(imagemRes);
                                    imagemRes.setAlignment(Image.ALIGN_CENTER);
                                    imagemRes.setBorder(Rectangle.BOX);
                                    imagemRes.setBorderWidth(1);
                                    imagemRes.setBorderColor(BaseColor.BLACK);
                                    document.newPage();
                                    document.add(imagemRes);

                                    legenda = new Chunk("Figura " + contImgs + " - " + Chars.utf8_decode(rsResMet.getString("nome_img_texto"))); 

                                    paragrafo.setAlignment(Paragraph.ALIGN_CENTER);
                                    paragrafo.setIndentationLeft(0);
                                    resetarParagrafo(fonteLegImg,legenda.toString());
                                    String strFonte = Chars.utf8_decode(rsResMet.getString("fonte_img_texto"));
                                    if(!strFonte.equals("Autoria própria")) {
                                        fonte = new Chunk("Fonte: " + strFonte);
                                        resetarParagrafo(fonteLegImg,fonte.toString());
                                    }

                                    document.add(Chunk.NEWLINE);
                                    
                                    contImgs++;
                                } catch (IOException e) {
                                    System.out.println("Erro na imagem ["+e.getMessage()+"]");
                                }
                            }
                            
                            if(rsResMet.getString("resultado") != null && !rsResMet.getString("resultado").isEmpty())
                            {
                                paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                                paragrafo.setFirstLineIndent(20.f);
                                resetarParagrafo(fonteNormal,Chars.utf8_decode(rsResMet.getString("resultado")));
                                document.add(Chunk.NEWLINE);
                            }
                            
                            if(rsResMet.getString("img_resultado") != null && !rsResMet.getString("img_resultado").isEmpty())
                            {
                                try {
                                    Image imagemRes = Image.getInstance(dirimg + rsResMet.getString("img_resultado"));
                                    
                                    setEscala(imagemRes);
                                    imagemRes.setAlignment(Image.ALIGN_CENTER);
                                    imagemRes.setBorder(Rectangle.BOX);
                                    imagemRes.setBorderWidth(1);
                                    imagemRes.setBorderColor(BaseColor.BLACK);
                                    document.newPage();
                                    document.add(imagemRes);

                                    legenda = new Chunk("Figura " + contImgs + " - " + Chars.utf8_decode(rsResMet.getString("nome_img_resultado"))); 

                                    paragrafo.setAlignment(Paragraph.ALIGN_CENTER);
                                    paragrafo.setIndentationLeft(0);
                                    resetarParagrafo(fonteLegImg,legenda.toString());
                                    String strFonte = Chars.utf8_decode(rsResMet.getString("fonte_img_resultado"));
                                    if(!strFonte.equals("Autoria própria")) {
                                        fonte = new Chunk("Fonte: " + strFonte);
                                        resetarParagrafo(fonteLegImg,fonte.toString());
                                    }

                                    document.add(Chunk.NEWLINE);
                                    
                                    contImgs++;
                                } catch (IOException e) {
                                    System.out.println("Erro na imagem ["+e.getMessage()+"]");
                                }
                            }
                            subsecao = secao.addSection(Chars.utf8_decode(rsResMet.getString("nome")));
                            indentar(subsecao,10);
                            contItem++;
                        }
                        contItemTitulo++;
                    }
                    
                    paragrafo.setFirstLineIndent(20.f);
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    document.newPage();
                    capitulos.add(capitulo);
                    /**************************************************************/
                    
                    contTitulos++;
                    resetarTitulo(tituloNegrito,contTitulos + " MATERIAIS",0);
                    
                    capitulo = transformarCap(capitulo,"MATERIAIS",contTitulos);
                    
                    titulo.setFont(tituloNormal);
                    int contMat = 1;
                    for (String material : materiais) 
                    {
                        if (material != null && !material.isEmpty())
                        {
                            material = decodificar(material);
                            resetarTitulo(null,contTitulos + "." + contMat + " " + material,0);
                            contMat++;
                            
                            secao = transformarSec(secao,capitulo,material);
                            indentar(secao,10);
                        }
                    }
                    capitulos.add(capitulo);
                    
                    document.newPage();
                    
                    contTitulos++;
                    
                    resetarTitulo(tituloNegrito,contTitulos + " CONCLUSÃO",0);
                    
                    capitulo = transformarCap(capitulo,"CONCLUSÃO",contTitulos);
                    capitulos.add(capitulo);
                    
                    paragrafo.setFont(fonteNormal);
                    paragrafo.setIndentationLeft(0);
                    paragrafo.setAlignment(Paragraph.ALIGN_JUSTIFIED);
                    for (String conclusao : conclusoes) {
                        if (conclusao != null && !conclusao.isEmpty()) {
                            conclusao = decodificar(conclusao);
                            resetarParagrafo(null,conclusao);
                        }
                    }
                    
                    document.newPage();
                    
                    contTitulos++;
                    
                    resetarTitulo(tituloNegrito,contTitulos + " REFERÊNCIAS BIBLIOGRÁFICAS",0);
                   
                    capitulo = transformarCap(capitulo,"REFERÊNCIAS BIBLIOGRÁFICAS", contTitulos);
                    capitulos.add(capitulo);
                    
                    PreparedStatement ref = conexao.prepareStatement("SELECT refCompleta FROM referencial_teorico WHERE iddocumento = ? ORDER BY refCompleta");
                    ref.setInt(1, idDoc);
                    ResultSet rsRef = ref.executeQuery();
                    
                    paragrafo.setFirstLineIndent(0);
                    paragrafo.setIndentationLeft(0);
                    paragrafo.setLeading(15.00f);
                    paragrafo.setAlignment(Paragraph.ALIGN_LEFT);
                    while (rsRef.next()) {
                        if(!rsRef.getString("refCompleta").isEmpty())
                        {
                            paragrafo.clear();
                            paragrafo.add(decodificar(rsRef.getString("refCompleta")));
                            document.add(paragrafo);
                            document.add(Chunk.NEWLINE);
                        }
                    }
                    
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* FIM DO DOCUMENTO *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
                    document.close();
                    /*======================================================================================*/
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* SUMÁRIO *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
                    Document doc = new Document(document.getPageSize());
                    doc.setMargins(document.leftMargin(), document.rightMargin(), document.topMargin(), document.bottomMargin());
                    FileOutputStream os = new FileOutputStream(root + "\\IndexPdf.pdf");
                    PdfWriter writer2 = PdfWriter.getInstance(doc, os);
                    doc.open();
                    
                    titulo.clear();
                    titulo.setAlignment(Paragraph.ALIGN_CENTER);
                    titulo.add("SUMÁRIO");
                    doc.add(titulo);
                    doc.add(Chunk.NEWLINE);
                    
                    ArrayList<String> indexes = new ArrayList<>();
                    for (Map.Entry<String, Integer> index : event.index.entrySet()) {
                        indexes.add(index.getValue().toString());
                    }
                    
                    int indexRec = 0;
                    
                    int y = 732; //início do Y
                    
                    //percorrer a chave index com os números das páginas de cada item do sumário (capitulos e seções)
                    for (int i = 0; i < indexes.size(); i++) {
                        //exibe as páginas da chave index
                        if (y < 40) {
                            indexRec = i;
                            break;
                        }
                        ColumnText.showTextAligned(writer2.getDirectContent(),Paragraph.ALIGN_RIGHT, new Phrase(indexes.get(i)),550,y,0);
                        y -= 18;
                    }
                    
                    //adicionar em uma ÚNICA página os itens do sumário: os capítulos e seções
                    for (int i = 0; i < capitulos.size(); i++) {
                       doc.add(capitulos.get(i).getTitle());
                       java.util.List<Element> subList = capitulos.get(i).subList(0, capitulos.get(i).size());
                       for (int j = 0; j < subList.size(); j++) {
                            java.util.List sec = subList.subList(0, subList.size());
                            Object o = sec.get(j);
                            Element e = Element.class.cast(o);
                            doc.add(e);
                        }
                    }
                    if(indexRec > 0) {
                        y = 764;
                        for (int i = indexRec; i < indexes.size(); i++) {
                            ColumnText.showTextAligned(writer2.getDirectContent(),Paragraph.ALIGN_RIGHT, new Phrase(indexes.get(i)),550,y,0);
                            y -= 18;
                        }
                    }
                    
                    doc.close();
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-* JUNÇÃO DO SUMÁRIO COM O DOCUMENTO *-*-*-*-*-*-*-*-*-*-*/
                    java.util.List<InputStream> pdfs = new ArrayList(); // arquivos necessários
                    pdfs.add(new FileInputStream(root + "\\IndexPdf.pdf")); // sumário
                    pdfs.add(new FileInputStream(root + "\\documento.pdf")); // o documento em si
                    ManipulatePDF merge = new ManipulatePDF(); // classe para junção do sumário ao documento
                    OutputStream output = new FileOutputStream(root + "\\merge.pdf"); // arquivo mesclado
                    merge.manipularPDF(pdfs, output, true);
                    // reorganização do sumário no documento
                    PdfReader reader = new PdfReader(root + "\\merge.pdf");
                    int startToc = 1;
                    int n = reader.getNumberOfPages();
                    if(indexRec > 0){
                        reader.selectPages(String.format("3,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("2,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("4,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("3,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                    } else {
                        reader.selectPages(String.format("2,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("1,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("3,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                        reader.selectPages(String.format("2,%s-%s, 2-%s, %s", startToc, n-1, startToc-1, n));
                    }
                    
                    File existe = new File(root + "\\" + nameDocument + ".pdf");
                    if (existe.exists()) existe.delete();
                    
                    //documento final
                    PdfStamper stamper = new PdfStamper(reader, new FileOutputStream(root + "\\" + nameDocument + ".pdf"));
                    stamper.close();
                    reader.close();
                    System.out.println(new File(root + "\\documento.pdf").delete());
                    System.out.println(new File(root + "\\IndexPdf.pdf").delete());
                    System.out.println(new File(root + "\\merge.pdf").delete());
                    finalizado = true;
                    /*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*/
                    /*======================================================================================*/
                } catch (DocumentException e) {
                    System.out.println("Erro no documento ["+e.getMessage()+"]");
                } catch (FileNotFoundException e) {
                    System.out.println("Erro FileNotFound ["+e.getMessage()+"]");
                } catch (IOException e) {
                    System.out.println("Erro IO ["+e.getMessage()+"]");
                }
            }
            Conexao.desconectar(conexao);
        } catch (SQLException e) {
            System.err.println("Erro de SQL ["+e.getMessage()+"]"); 
        }
    }
    
    public static void resetarTitulo(Font fonte, String conteudo, float indentacao) throws DocumentException 
    {
        titulo.clear();
        if(fonte != null) titulo.setFont(fonte);
        titulo.setAlignment(Paragraph.ALIGN_LEFT);
        titulo.add(conteudo);
        document.add(titulo);
        document.add(Chunk.NEWLINE);
        event.index.put(conteudo,event.getPagina());
    }
    
    public static void resetarParagrafo(Font fonte, String conteudo) throws DocumentException 
    {
        paragrafo.clear();
        if(fonte != null) paragrafo.setFont(fonte);
        paragrafo.add(conteudo);
        document.add(paragrafo);
    }
    
    public static void indentar(Section secao,float identacao) 
    {
        secao.setIndentationLeft(identacao);
        //-1, 0 -> Nenhuma marcação, 1 -> Uma marcação, 2 -> Duas marcações,...
        secao.setNumberDepth(3);
        secao.setNumberStyle(Section.NUMBERSTYLE_DOTTED_WITHOUT_FINAL_DOT);
    }
    
    public static Chapter transformarCap(Chapter capitulo, String tituloCap, int ref) 
    {
        capitulo = new Chapter(tituloCap,ref);
        capitulo.setNumberDepth(1);
        capitulo.setNumberStyle(Chapter.NUMBERSTYLE_DOTTED_WITHOUT_FINAL_DOT);
        return capitulo;
    }
    
    public static Section transformarSec(Section secao,Chapter capitulo,String titulo) 
    {
        secao = capitulo.addSection(titulo);
        return secao;
    }
    
    public static String decodificar(String conteudo)
    {
        return Chars.decode(conteudo);
    }
    
    public static void setValores(int iddoc, int idequipe) 
    {
        idDoc = iddoc;
        idEquipe = idequipe;
    }
    
    public static void setRoot(String path) 
    {
        root = path;
    }
    
    public static boolean finalizado() 
    {
        return finalizado;
    }
    
    public static void setEscala(Image imagem)
    {
        float escala;
        if(imagem.getWidth() >= 495 || imagem.getHeight() >= 495) {
            escala = ((document.getPageSize().getWidth() - document.leftMargin()
            - document.rightMargin() - 0) / imagem.getWidth()) * 100;
            imagem.scalePercent(escala);
        }
    }
}