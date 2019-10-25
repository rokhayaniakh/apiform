<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* partenaire/index.html.twig */
class __TwigTemplate_ce4ff3a1ff2ee02258b95cc5747fa5b5ad40a2db5f37fd99493ff126ac503244 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "partenaire/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "partenaire/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Hello PartenaireController!
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 4
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "    <h1 class=\"jumbotron\">Contrat de prestation de service</h1>
    <h4>Description:</h4>
    <p>Dans le cadre d'un contrat de services, le prestataire fournit au client une prestation à caractère intellectuel.
        <br>
        Il lui apporte son savoir-faire pour l'aider à améliorer sa rentabilité en lui permettant 
        de tirer un meilleur parti de sa structure ou de réduire ses coûts.
    </p>
    <p>Cette prestation peut s'exercer dans des domaines très divers tels que :</p>
    <ul>
        <li>le conseil en recrutement,</li>
        <li>le marketing,</li>
        <li>le conseil en organisation,</li>
        <li>la publicité,</li>
        <li>etc.</li>
    </ul>
    <h4>Notice:</h4>
    <p>Il est important que le contrat que les parties doivent signer pour toute prestation de service
                                            indique très précisément :</p>
    <ul>
        <li>les coordonnées exactes du prestataire et du client,</li>
        <li>les besoins exprimés par le client et les moyens que le prestataire mettra
                                                        en œuvre pour y répondre,</li>
        <li>les obligations dont chacune des parties devra s'acquitter,</li>
        <li>le prix de la mission (ou son mode de calcul).</li>
    </ul>
    <p style=\"color:red\">
        <h3>Entre les soussignés :</h3>
        [Raison sociale du prestataire, forme juridique, montant de son capital social, adresse de son siège social, numéro d’immatriculation au RCS
                                et ville où se trouve le greffe qui tient le RCS où il est immatriculé]</p><br>

    <p>
        <span style=\"color:black\">Représenté par</span>
    </p>
    <p style=\"red\">
        [prénom et nom du représentant du prestataire, nature de sa fonction et date à laquelle il a été habilité à signer pour le compte de la société qu’il représente, prénom, nom
                                  et fonction de la personne qui l’a habilité]</p><br>

    <span style=\"color:black\">Ci-après désigné « le Prestataire » 
                                D’une part,
    </span><br>
    <b style=\"color:black\">Et :</b>

    <p style=\"color:red\">[Raison sociale du client, forme juridique, montant de son capital social, adresse de son siège social, numéro d’immatriculation au RCS et ville où se trouve le greffe qui tient le RCS où il est immatriculé]</p>
    Représenté par
    <p style=\"color:red\">[prénom et nom du représentant du client, nature de sa fonction et date à laquelle il a été habilité à signer pour le compte de la société qu’il représente, prénom, nom et fonction de la personne qui l’a habilité]</p>
</p>
<span style=\"color:black\">Ci-après désigné « le Client »
                D’autre part,
</span><br>
<b style=\"font-size:16px\">Il a été arrêté et convenu ce qui suit :</b><br><br><br>
<b>Article un - Nature de la mission</b>
<p>Le Client confie au Prestataire une mission consistant à
                répondre aux besoins suivants :</p>
<p style=\"color:red\">[Indiquer les besoins du client et les services que le prestataire s'engage à fournir pour y répondre].</p></p>Le cas échéant :<p>Dans le cadre de cette mission, le Prestataire s'engage à mettre ses collaborateurs à la disposition du Client si cela est nécessaire pour la bonne exécution de la mission. Cependant, lesdits salariés resteront sous l'autorité et sous la responsabilité du Prestataire
                pendant leur intervention chez le Client.</p><b>Article deux - Prix et modalités de paiement</b> <br>
                    Au choix selon le cas :<p>
• Le Client s’engage à payer au Prestataire un prix total de [x] € hors taxes payable selon l’échéancier suivant :
<br>
<pre>
        [x] € hors taxes lors de la signature du présent contrat,<br>
        [x] € hors taxes en fin de mission.
        </pre><br>
• Le Client s'engage à payer un prix fixé en fonction d'un tarif horaire de [x] € hors taxes.</p><p>D’autre part, il s’engage à rembourser au Prestataire les éventuels frais de déplacement ou de séjour à l’hôtel qui seraient nécessités pour l’exécution de la mission. Ces frais seront engagés après accord écrit du Client et
                ils devront être remboursés sur présentation des justificatifs.</p><b>Article trois - Obligations du Prestataire</b><p>
Il est rappelé que le Prestataire est tenu à une obligation de moyens. Il doit donc exécuter sa mission conformément aux règles en vigueur dans sa profession et en se conformant
 à toutes les données acquises dans son domaine de compétence.<br>
Il reconnaît que le Client lui a donné une information complète sur ses besoins et sur les impératifs à respecter.<br>
Il s'engage à se conformer au règlement intérieur et aux consignes de sécurité applicables chez le Client.<br>
Enfin, il s’engage à observer la confidentialité la plus totale en ce qui concerne le contenu de la mission et toutes les informations ainsi que tous les documents que le Client lui aura communiqués.</p>
<b>Article quatre - Obligations du Client<b>
    <p>Afin de permettre au Prestataire de réaliser la mission dans 
                                de bonnes conditions, le Client s’engage à lui remettre tous les
                                documents nécessaires dans les meilleurs délais.</p>
    <b>Article cinq – Responsabilité</b>

    <p>La responsabilité du Prestataire ne pourra être mise en cause qu'en cas 
                                de manquement à son obligation de moyens. En outre, le Client ne pourra pas 
                                l'invoquer dans les cas suivants :</p>
    <p>
        • s'il a omis de remettre au Prestataire un document ou une information nécessaire pour la mission,<br>

        • en cas de force majeure ou d'autres causes indépendantes de la volonté du Prestataire
    </p><br>
    <b>Article six - Droit applicable et juridiction compétente<b><br><br>

            <p>Le présent contrat est assujetti au droit français. Tout litige qui 
                                                                résulterait de son exécution sera soumis aux tribunaux dont dépend le siège 
                                                                social du Prestataire.</p>

            <p>Fait le [
            <span style=\"color:red\">date</span>] en deux exemplaires à [<span style=\"color:red\">ville</span>]</p>
            <table class=\"table table-striped table-bordered\">
                <tr>
                    <td>Le Prestataire
                                                                                                [
                        <span style=\"color:red\">nom du signataire</span>]</td>
                    <td>Le Client
                                                                                    [
                        <span style=\"color:red\">nom du signataire</span>]</td>
                </tr>
                <tr>
                    <td>[
                        <span style=\"color:red\">signature</span>]</td>
                    <td>
                        [
                        <span style=\"color:red\">signature</span>]</td>
                </tr>
            </table>
        ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "partenaire/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 5,  67 => 4,  53 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}
{% block title %}Hello PartenaireController!
{% endblock %}
{% block body %}
    <h1 class=\"jumbotron\">Contrat de prestation de service</h1>
    <h4>Description:</h4>
    <p>Dans le cadre d'un contrat de services, le prestataire fournit au client une prestation à caractère intellectuel.
        <br>
        Il lui apporte son savoir-faire pour l'aider à améliorer sa rentabilité en lui permettant 
        de tirer un meilleur parti de sa structure ou de réduire ses coûts.
    </p>
    <p>Cette prestation peut s'exercer dans des domaines très divers tels que :</p>
    <ul>
        <li>le conseil en recrutement,</li>
        <li>le marketing,</li>
        <li>le conseil en organisation,</li>
        <li>la publicité,</li>
        <li>etc.</li>
    </ul>
    <h4>Notice:</h4>
    <p>Il est important que le contrat que les parties doivent signer pour toute prestation de service
                                            indique très précisément :</p>
    <ul>
        <li>les coordonnées exactes du prestataire et du client,</li>
        <li>les besoins exprimés par le client et les moyens que le prestataire mettra
                                                        en œuvre pour y répondre,</li>
        <li>les obligations dont chacune des parties devra s'acquitter,</li>
        <li>le prix de la mission (ou son mode de calcul).</li>
    </ul>
    <p style=\"color:red\">
        <h3>Entre les soussignés :</h3>
        [Raison sociale du prestataire, forme juridique, montant de son capital social, adresse de son siège social, numéro d’immatriculation au RCS
                                et ville où se trouve le greffe qui tient le RCS où il est immatriculé]</p><br>

    <p>
        <span style=\"color:black\">Représenté par</span>
    </p>
    <p style=\"red\">
        [prénom et nom du représentant du prestataire, nature de sa fonction et date à laquelle il a été habilité à signer pour le compte de la société qu’il représente, prénom, nom
                                  et fonction de la personne qui l’a habilité]</p><br>

    <span style=\"color:black\">Ci-après désigné « le Prestataire » 
                                D’une part,
    </span><br>
    <b style=\"color:black\">Et :</b>

    <p style=\"color:red\">[Raison sociale du client, forme juridique, montant de son capital social, adresse de son siège social, numéro d’immatriculation au RCS et ville où se trouve le greffe qui tient le RCS où il est immatriculé]</p>
    Représenté par
    <p style=\"color:red\">[prénom et nom du représentant du client, nature de sa fonction et date à laquelle il a été habilité à signer pour le compte de la société qu’il représente, prénom, nom et fonction de la personne qui l’a habilité]</p>
</p>
<span style=\"color:black\">Ci-après désigné « le Client »
                D’autre part,
</span><br>
<b style=\"font-size:16px\">Il a été arrêté et convenu ce qui suit :</b><br><br><br>
<b>Article un - Nature de la mission</b>
<p>Le Client confie au Prestataire une mission consistant à
                répondre aux besoins suivants :</p>
<p style=\"color:red\">[Indiquer les besoins du client et les services que le prestataire s'engage à fournir pour y répondre].</p></p>Le cas échéant :<p>Dans le cadre de cette mission, le Prestataire s'engage à mettre ses collaborateurs à la disposition du Client si cela est nécessaire pour la bonne exécution de la mission. Cependant, lesdits salariés resteront sous l'autorité et sous la responsabilité du Prestataire
                pendant leur intervention chez le Client.</p><b>Article deux - Prix et modalités de paiement</b> <br>
                    Au choix selon le cas :<p>
• Le Client s’engage à payer au Prestataire un prix total de [x] € hors taxes payable selon l’échéancier suivant :
<br>
<pre>
        [x] € hors taxes lors de la signature du présent contrat,<br>
        [x] € hors taxes en fin de mission.
        </pre><br>
• Le Client s'engage à payer un prix fixé en fonction d'un tarif horaire de [x] € hors taxes.</p><p>D’autre part, il s’engage à rembourser au Prestataire les éventuels frais de déplacement ou de séjour à l’hôtel qui seraient nécessités pour l’exécution de la mission. Ces frais seront engagés après accord écrit du Client et
                ils devront être remboursés sur présentation des justificatifs.</p><b>Article trois - Obligations du Prestataire</b><p>
Il est rappelé que le Prestataire est tenu à une obligation de moyens. Il doit donc exécuter sa mission conformément aux règles en vigueur dans sa profession et en se conformant
 à toutes les données acquises dans son domaine de compétence.<br>
Il reconnaît que le Client lui a donné une information complète sur ses besoins et sur les impératifs à respecter.<br>
Il s'engage à se conformer au règlement intérieur et aux consignes de sécurité applicables chez le Client.<br>
Enfin, il s’engage à observer la confidentialité la plus totale en ce qui concerne le contenu de la mission et toutes les informations ainsi que tous les documents que le Client lui aura communiqués.</p>
<b>Article quatre - Obligations du Client<b>
    <p>Afin de permettre au Prestataire de réaliser la mission dans 
                                de bonnes conditions, le Client s’engage à lui remettre tous les
                                documents nécessaires dans les meilleurs délais.</p>
    <b>Article cinq – Responsabilité</b>

    <p>La responsabilité du Prestataire ne pourra être mise en cause qu'en cas 
                                de manquement à son obligation de moyens. En outre, le Client ne pourra pas 
                                l'invoquer dans les cas suivants :</p>
    <p>
        • s'il a omis de remettre au Prestataire un document ou une information nécessaire pour la mission,<br>

        • en cas de force majeure ou d'autres causes indépendantes de la volonté du Prestataire
    </p><br>
    <b>Article six - Droit applicable et juridiction compétente<b><br><br>

            <p>Le présent contrat est assujetti au droit français. Tout litige qui 
                                                                résulterait de son exécution sera soumis aux tribunaux dont dépend le siège 
                                                                social du Prestataire.</p>

            <p>Fait le [
            <span style=\"color:red\">date</span>] en deux exemplaires à [<span style=\"color:red\">ville</span>]</p>
            <table class=\"table table-striped table-bordered\">
                <tr>
                    <td>Le Prestataire
                                                                                                [
                        <span style=\"color:red\">nom du signataire</span>]</td>
                    <td>Le Client
                                                                                    [
                        <span style=\"color:red\">nom du signataire</span>]</td>
                </tr>
                <tr>
                    <td>[
                        <span style=\"color:red\">signature</span>]</td>
                    <td>
                        [
                        <span style=\"color:red\">signature</span>]</td>
                </tr>
            </table>
        {% endblock %}
", "partenaire/index.html.twig", "/home/rokhayadiop/Documents/symfony/formapi/templates/partenaire/index.html.twig");
    }
}
