package utl;

import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;

public class Chars {
    
    public static final String htmlentities[] = {
        /****** A ******/
        "&Aacute;","&aacute;","&Acirc;","&acirc;","&Agrave;","&agrave;","&Aring;","&aring;","&Atilde;","&atilde;",
        "&Auml;","&auml;","&AElig;","&aelig;",
        /****** E ******/
        "&Eacute;","&eacute;","&Ecirc;","&ecirc;","&Egrave;","&egrave;","&Euml;","&euml;",
        /****** I ******/
        "&Iacute;","&iacute;","&Icirc;","&icirc;","&Igrave;","&igrave;","&Iuml;","&iuml;",
        /****** O ******/
        "&Oacute;","&oacute;","&Ocirc;","&ocirc;","&Ograve;","&ograve;","&Oslash;","&oslash;","&Otilde;","&otilde;","&Ouml;","&ouml;",
        /****** U ******/
        "&Uacute;","&uacute;","&Ucirc;","&ucirc;","&Ugrave;","&ugrave;","&Uuml;","&uuml;",
        /****** Outros ******/
        "&Ccedil;","&ccedil;","&Ntilde;","&ntilde;","&amp;","&quot;","&reg;","&copy;","&trade;","&Yacute;","&yacute;","&ordf;","&ordm;","&rdquo;","&ldquo;",
        /***** Símbolos Matemáticos *****/
        "&alpha;","&beta;","&gamma;","&delta;","&Delta;","&theta;","&lambda;","&pi;",
        "&sum;","&radic;","&infin;","&cap;",
        "&lt;","&gt;","&le;","&ge;","&int;","&asymp;","&ne;","&equiv;",
        
        "ÃƒÂ³"
    };
    
    public static final String chars[] = {
        /***** A *****/
        "Á","á","Â","â","À","à","Å","å","Ã","ã","Ä","ä","Æ","æ",
        /***** E *****/
        "É","é","Ê","ê","È","è","Ë","ë",
        /***** I *****/
        "Í","í","Î","î","Ì","ì","Ï","ï",
        /***** O *****/
        "Ó","ó","Ô","ô","Ò","ò","Ø","ø","Õ","õ","Ö","ö",
        /***** U *****/
        "Ú","ú","Û","û","Ù","ù","Ü","ü",
        /***** Outros *****/
        "Ç","ç","Ñ","ñ","&","\"","®","©","™","Ý","ý","ª","º","\"","\"",
        /***** Símbolos Matemáticos *****/
        "α","β","γ","δ","Δ","Θ","λ","π",
        "∑","√","∞","∩",
        "<",">","≤","≥","∫","≈","≠","≡",
        
        "ó"
    };
    
    public static String decode(String texto){
        for (int i = 0; i < htmlentities.length; i++) 
        {
            if (texto.contains(htmlentities[i])) {
                texto = texto.replaceAll(htmlentities[i],chars[i]);
            }
        }
        return texto;
    }
    
    public static String utf8_decode(String texto){
        String ret = null;
	try {
		ret = new String(texto.getBytes("ISO-8859-1"), "UTF-8");
	}
	catch (java.io.UnsupportedEncodingException e) {
            return null;
	}
	return ret;
    }
}