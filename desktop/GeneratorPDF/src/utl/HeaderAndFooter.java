package utl;

import com.itextpdf.text.Document;
import com.itextpdf.text.Element;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.pdf.ColumnText;
import com.itextpdf.text.pdf.PdfPageEventHelper;
import com.itextpdf.text.pdf.PdfWriter;
import java.util.LinkedHashMap;
import java.util.Map;

public class HeaderAndFooter extends PdfPageEventHelper {
    private int pagina;
    public Map<String, Integer> index = new LinkedHashMap<>();
    
    public int getPagina() {
        return pagina;
    }
    
    public void setPagina(int pagina) {
        this.pagina = pagina;
    }
    
   @Override
    public void onStartPage(PdfWriter writer, Document document) {
        pagina++;
        //posicionar a numeração no topo da página
        ColumnText.showTextAligned(writer.getDirectContent(), Element.ALIGN_CENTER, new Phrase(""+pagina),550,810,0);
    }
    
   @Override
    public void onEndPage(PdfWriter writer, Document document) {
        // A ser implementado
    } 
    
    @Override
    public void onChapter(PdfWriter writer, Document document, float paragraphPosition, Paragraph title) {
        
    }
    
    @Override
    public void onSection(PdfWriter writer, Document document, float paragraphPosition, int depth, Paragraph title) {
	onChapter(writer, document, paragraphPosition, title);
    }
}