function loadText()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Eksempel";
    txtLang[1].innerHTML = "CSS tekst";
    txtLang[2].innerHTML = "Class navn";
    txtLang[3].innerHTML = "Tilf\u00F8j til";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Valgte tekst"
    optLang[1].text = "Aktuelle kodetag"

    document.getElementById("btnCancel").value = "Annuller";
    document.getElementById("btnApply").value = "Tilf\u00F8j";
    document.getElementById("btnOk").value = " Ok ";
    }
function getText(s)
    {
    switch(s)
        {
        case "You're selecting BODY element.":
            return "Du kan ikke formatere BODY elementet.";
        case "Please select a text.":
            return "Der skal markeres en tekst f\u00F8r opdatering kan ske.";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Egne formateringer</title>")
    }