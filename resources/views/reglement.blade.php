@extends('layouts.master')

@section('title', 'Politique & CGV')

@include('layouts.navbar')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


<link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

@stop


@section('content')
<!-- ================= SUCCESS AND ERROR MODAL ============== -->
@if (session()->has('success_message'))
<!-- Modal success-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
      <div class="modal-header shadow-lg bg">
        <button type="button" class="close text-danger rounded" data-dismiss="modal" aria-label="Close">
          <span  aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg p-4 text-dark b text-center">
        {!! session()->get('success_message') !!}
        
      </div>
    </div>
  </div>
</div>
@endif

@if ($errors->count() > 0)
<!-- Modal  errors-->
<div class="modal fade " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content bg-transparent shadow-lg border solid borger-light text-light">
      @foreach($errors->all() as $error)
      <div class="modal-body bg  text-danger p-4 b text-center">
        {{ $error }}
        <button type="button" class="close text-danger " data-dismiss="modal" aria-label="Close">
          <span class="badge badge-danger p-2" aria-hidden="true">&times;</span>
        </button>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endif
<!-- ================= SUCCESS AND ERROR MODAL ============== -->
<div class="container-fluid px-5 py-5"> 
  <div class="row">
    <div class="col-md-3 card p-3 shadow">
      <h6 class="p-2 b text-danger text-center">Politiques et informations légales</h6>
      <h5 class="text-muted text-center p-2">
        
        CONDITIONS D'UTILISATION ET GENERALES DE VENTE
      </h5>
      <ul class="navbar-nav nav ">  
        <li class="nav-item"><a href="#" class="nav-link">Protection de vos informations personnelles</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Protection de vos informations personnelles</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Politique Kalisso en matière de lutte contre les produits contrefaits</a> </li>
        <li class="nav-item"><a class="nav-link" href="#">A propos des navigateurs compatibles</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Identifier si un e-mail, appel téléphonique ou SMS proviennent Kalisso</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Annonces basées sur vos centres d'intérêt</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Normes applicables à la chaîne logistique</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Systèmes de protection de la vie privée</a></li>
        <li class="nav-item"><a class="nav-link" href="#">A propos des informations recueillies par Kalisso</a></li>
      </ul> 
    </div>  
    <div class="col-md-9">
      <hr><br>
      <label class="b h4">Trouvez d'autres solutions</label>
      <form method="GET" class="d-block" style="transform: inherit;">
        <div class="input-group mb-5">
          
          <input type="search" name="search" placeholder="Rechercher " class="form-control ">
          <button class="btn btn-outline-info ">  
            <i class="fa fa-search"></i>
          </button>

        </div>
      </form>  
      <hr><br>
      <div class="px-3 mt-5"> 
        <p class="text-justify">  
          <p class="b h3">CONDITIONS D'UTILISATION ET GENERALES DE VENTE</p><br><br>
          Dernière mise à jour le 22 mai 2020. Pour consulter la version précédente, rendez-vous ici.<br>
          <br>
          Bienvenue sur <strong>Kalisso</strong>.com.<br>
          <br><br>
          <strong>Kalisso</strong> Afrique SARL, <strong>Kalisso</strong> EU SARL et/ou leurs sociétés affiliées (« <strong>Kalisso</strong> ») vous fournissent des fonctionnalités de site internet et d'autres produits et services quand vous visitez le site internet <strong>Kalisso</strong>.com (le « site internet »), effectuer des achats sur le site Internet, utiliser des appareils, produits et services <strong>Kalisso</strong>, utiliser des applications <strong>Kalisso</strong> pour mobile, utiliser des logiciels fournis par <strong>Kalisso</strong> dans le cadre de tout ce qui précède (ensemble ci-après, les « Services <strong>Kalisso</strong> »). Veuillez consulter notre Notice Protection de vos Informations Personnelles, notre Notice Cookies et notre Notice Annonces publicitaires basées sur vos centres d'intérêt pour comprendre comment nous collectons et traitons vos informations personnelles dans le cadre des Services <strong>Kalisso</strong>. <strong>Kalisso</strong> fournit les Services <strong>Kalisso</strong> et vend des produits selon les conditions définies sur cette page. <strong>Kalisso</strong>.com est le nom commercial utilisé par <strong>Kalisso</strong>.
          <br><br><br>
          Conditions d'utilisation
          <br><br><br>
          Conditions Générales de Vente
          <br><br><br>
          CONDITIONS D'UTILISATION
          Merci de lire ces conditions attentivement avant d'utiliser les Services <strong>Kalisso</strong>. En utilisant les Services <strong>Kalisso</strong>, vous acceptez d'être soumis aux présentes conditions. Nous offrons un large panel de Services <strong>Kalisso</strong> et il se peut que des conditions additionnelles s'appliquent. Quand vous utilisez un Service <strong>Kalisso</strong> (par exemple, Votre Profil, les Chèques-Cadeaux ou les Applications <strong>Kalisso</strong> pour mobile), vous êtes aussi soumis aux termes, lignes directrices et conditions applicables à ce Service <strong>Kalisso</strong> (« Conditions du Service »). Si ces Conditions d'Utilisation entrent en contradiction avec ces Conditions du Service, les Conditions du Service prévaudront.
          <br><br><br>
          Procédure et formulaire de notification de violation de droits.
          <br><br><br>
          Procédure et Formulaire de notification en vue de notifier un contenu injurieux ou diffamatoire.
          <br><br><br>
          1. COMMUNICATIONS ELECTRONIQUES
          <br>
          Quand vous utilisez un quelconque Service <strong>Kalisso</strong> ou que vous nous envoyez des courriers électroniques, SMS ou autres communications depuis vos équipements fixes ou mobiles, vous communiquez avec nous électroniquement. Nous communiquerons avec vous électroniquement par divers moyens, tels que par courrier électronique, SMS, messages de notification dans l'application ou en postant des courriers électroniques ou des communications sur le site internet ou à travers les autres Services <strong>Kalisso</strong>, tels que notre Gestionnaire de communication. A des fins contractuelles, vous acceptez que tous les accords, informations, divulgations et autres communications que nous vous enverrons électroniquement remplissent toutes les obligations légales des communiquer par écrit, à moins qu'une loi impérative spécifique impose un autre mode de communication.
          <br>
          2. RECOMMANDATIONS ET PERSONNALISATION
          <br>
          Dans le cadre des Services <strong>Kalisso</strong>, nous vous recommanderons des fonctionnalités, des produits et des services, comprenant des publicités de tiers, qui sont susceptibles de vous intéresser, nous identifierons vos préférences et nous personnaliserons votre expérience.
          <br>
          3. PROPRIETE INTELLECTUELLE, DROIT D'AUTEUR, ET PROTECTION DES BASES DE DONNEES
          Tout le contenu présent ou rendu disponible à travers les Services <strong>Kalisso</strong>, tels que les textes, les graphiques, les logos, les boutons, les images, les morceaux de musique, les téléchargements numériques, et les compilations de données, est la propriété <strong>Kalisso</strong>, de ses sociétés affiliées ou de ses fournisseurs de contenu et est protégé par le droit luxembourgeois et international de la propriété intellectuelle, d'auteur et de protection des bases de données. La compilation de tout le contenu présent ou rendu disponible à travers les Services <strong>Kalisso</strong> est la propriété exclusive <strong>Kalisso</strong> et est protégé par le droit luxembourgeois et international de la propriété intellectuelle et de protection des bases de données.
          <br>
          Vous ne devez pas extraire et/ou réutiliser de façon systématique des parties du contenu de tout Service <strong>Kalisso</strong> sans notre autorisation expresse et écrite. En particulier, vous ne devez pas utiliser de robot d'aspiration de données, ou tout autre outil similaire de collecte ou d'extraction de données pour extraire (en une ou plusieurs fois), pour réutiliser une partie substantielle d'un quelconque Service <strong>Kalisso</strong>, sans notre accord express et écrit. Vous ne devez pas non plus créer et/ou publier vos propres bases de données qui comporteraient des parties substantielles (ex : nos price et nos listes de produits) d'un Service <strong>Kalisso</strong> sans notre accord express et écrit.
          <br>
          4. MARQUES DEPOSEES
          <br>
          Cliquer ici pour voir une liste non exhaustive des marques déposées par <strong>Kalisso</strong>. Par ailleurs, les graphiques, logos, en-têtes de page, boutons, scripts et noms de services inclus ou rendus disponibles à travers un Service <strong>Kalisso</strong> sont des marques ou visuels <strong>Kalisso</strong>. Les marques et visuels <strong>Kalisso</strong> ne peuvent pas être utilisés pour des produits ou services qui n'appartiennent pas à <strong>Kalisso</strong>, ou d'une quelconque manière qui pourrait provoquer une confusion parmi les clients, ou d'une quelconque manière qui dénigre ou discrédite <strong>Kalisso</strong>. Toutes les autres marques qui n'appartiennent pas à <strong>Kalisso</strong> et qui apparaissent sur un quelconque Service <strong>Kalisso</strong> sont la propriété de leurs propriétaires respectifs, qui peuvent, ou non, être affiliés, liés ou parrainés par <strong>Kalisso</strong>.
          <br>
          5. BREVETS

          Un ou plusieurs brevets détenus par <strong>Kalisso</strong> s'appliquent aux Services <strong>Kalisso</strong>, à ce site internet et aux fonctionnalités et services accessibles via le site internet et les Services <strong>Kalisso</strong>. Des parties de ce site internet fonctionnent sous licences d'un ou plusieurs brevets. Cliquer ici pour voir une liste non exhaustive des brevets détenus par <strong>Kalisso</strong> et des licences de brevets applicables.
          <br>
          6. LICENCE ET ACCES
          <br>
          Sous réserve du respect des présentes Conditions d'Utilisation et des Conditions des Services et du paiement de tous les sommes applicables, <strong>Kalisso</strong> ou ses fournisseurs de contenu vous accorde une licence limitée, non exclusive, non transférable, non sous licenciable pour l'accès et à l'utilisation personnelle et non commerciale des Services <strong>Kalisso</strong>. Cette licence n'inclut aucun droit d'utilisation d'un Service <strong>Kalisso</strong> ou de son contenu pour la vente ou tout autre utilisation commerciale ; de collecte et d'utilisation d'un listing produit, descriptions, ou price de produits; de toute utilisation dérivée d'un Service <strong>Kalisso</strong> ou de son contenu ; de tout téléchargement ou copie des informations d'un compte pour un autre commerçant ; ou de toute utilisation de robot d'aspiration de données, ou autre outil similaire de collecte ou d'extraction de données.
          <br>
          Tous les droits qui ne vous ont pas été expressément accordés dans ces Conditions d'Utilisation ou dans les Conditions d'un Service sont réservés et restent à <strong>Kalisso</strong> ou à ses licenciés, fournisseurs, éditeurs, titulaires de droits, ou tout autre fournisseur de contenu. Aucun Service <strong>Kalisso</strong> ou tout ou partie de celui-ci ne doit être reproduit, copié, vendu, revendu, visité ou exploité pour des raisons commerciales sans notre autorisation expresse et écrite.
          <br>
          Vous ne devez pas cadrer ou utiliser des techniques de cadrage (framing) pour insérer toute marque, logo ou autre information commerciale (y compris des images, textes, mises en pages ou formes) <strong>Kalisso</strong> sans notre autorisation expresse et écrite. Vous ne devez pas utiliser de méta tags ou tout autre « texte caché » utilisant le nom ou les marques déposées <strong>Kalisso</strong> sans notre autorisation expresse et écrite.
          <br>
          Vous ne devez pas faire un mauvais usage d'un Service <strong>Kalisso</strong>. Vous devez utiliser les Services <strong>Kalisso</strong> comme autorisé par la loi. Les licences accordées par <strong>Kalisso</strong> prendront fin si vous ne respectez pas ces Conditions d'Utilisation ou les Conditions des Services.
          <br>
          7. VOTRE COMPTE
          <br>
          Vous pouvez avoir besoin d'un compte personnel <strong>Kalisso</strong> pour utiliser certain Services <strong>Kalisso</strong>, et il peut vous être demandé de vous connecter au compte et d'avoir une méthode de paiement valide associée à celui-ci. En cas de problème pour utiliser la méthode de paiement que vous avez sélectionnée, nous pourrons utiliser toute autre méthode de paiement valide associée à votre compte. Cliquez ici pour gérer vos options de paiement.
          <br>
          Si vous utilisez un quelconque Service <strong>Kalisso</strong>, vous êtes responsable du maintien de la confidentialité de votre compte et mot de passe, des restrictions d'accès à votre ordinateur et autres équipements, et dans la limite de ce qui est autorisé par la loi applicable, vous acceptez d'être responsable de toutes les activités qui ont été menées depuis de votre compte ou avec votre mot de passe. Vous devez prendre toutes les mesures nécessaires pour vous assurer que votre mot de passe reste confidentiel et sécurisé, et devez nous informer immédiatement si vous avez des raisons de croire que votre mot de passe est connu de quelqu'un d'autre, ou si le mot de passe est utilisé ou susceptible d'être utilisé de manière non autorisée. Vous êtes responsable de la validité et du caractère complets des informations que vous nous avez fournies, et devez nous informer de tout changement concernant ces informations. Vous pouvez accéder à vos informations dans la section Votre compte du site internet. Veuillez consulter nos pages d'aide relatives à la Protection de vos informations personnelles pour accéder à vos informations personnelles.
          <br>
          Vous ne devez pas utiliser un quelconque Service <strong>Kalisso</strong> : (i) d'une façon qui causerait, ou serait susceptible de causer une interruption, un dommage, ou une altération d'un Service <strong>Kalisso</strong>, or (ii) dans un but frauduleux, ou en relation avec un crime ou une activité illégale, ou (iii) dans le but provoquer des troubles, nuisances ou causes d'anxiétés.
          <br>
          Nous nous réservons le droit de refuser l'accès, de fermer un compte, de retirer ou de modifier du contenu si vous êtes en violation des lois applicables, de ces Conditions d'utilisation ou tous autres termes, conditions, lignes directrices ou politique <strong>Kalisso</strong>.
          <br>
          8. COMMENTAIRES, CRITIQUES, COMMUNICATIONS ET AUTRE CONTENU
          <br>
          Les visiteurs peuvent mettre en ligne des revues, des commentaires ou tout autre contenu ; envoyer des cartes électroniques ou autres communications, et soumettre des suggestions, des idées, des questions ou toute autre information tant que ce contenu n'est pas illégal, obscène, abusif, menaçant, diffamatoire, calomnieux, contrevenant aux droits de propriété intellectuelle, ou préjudiciable à des tiers ou répréhensible et ne consiste pas ou ne contient pas de virus informatiques, de militantisme politique, de sollicitations commerciales, de chaînes de courriers électroniques, de mailing de masse ou toute autre forme de « spam ». Vous ne devez pas utiliser une fausse adresse e-mail, usurper l'identité d'une personne ou d'une entité, ni mentir sur l'origine d'une carte de crédit ou d'un contenu. Nous nous réservons le droit (sans aucune obligation en l'absence d'un Formulaire de Notification valide), de retirer ou de modifier tout contenu. Si vous pensez qu'un contenu ou une annonce de vente sur un quelconque Service <strong>Kalisso</strong> contient un message diffamatoire, ou que vos droits de propriété intellectuelle ont été enfreints par un article ou une information sur le site internet, merci de nous le notifier en complétant le Formulaire de Notification adéquat, et nous y répondrons.
          <br>
          Si vous publiez des commentaires clients, , des questions / réponses ou tout autre contenu généré par vous pour être publié sur le site internet (incluant toute image, vidéo ou enregistrement audio, ensemble le « contenu ») , vous accordez à <strong>Kalisso</strong>, (i) une licence non-exclusive et gratuite pour utiliser, reproduire, , publier, rendre disponible, traduire et modifier ce contenu dans le monde entier(incluant le droit de sous-licencier ces droits à des tiers); et (b) le droit d'utiliser le nom que vous avez utilisé en lien avec ce contenu. Aucuns droits moraux ne sont transférés par l'effet de cette clause.
          <br>
          Vous pouvez supprimer votre contenu de la vue du public ou, lorsque cette fonctionnalité est offerte, modifier les paramètres pour qu'il ne soit visible que par les personnes auxquelles vous en avez donné l'accès. Vous déclarez et garantissez être propriétaire ou avoir les droits nécessaires sur le contenu que vous publiez ; que, à la date de publication du contenu ou du matériel : (i) le contenu et le matériel est exact, (ii) l'utilisation du contenu et du matériel que vous avez fourni ne contrevient pas à l'une des procédures ou lignes directrices <strong>Kalisso</strong> et ne portera pas atteinte à toute personne physique ou morale (notamment que le contenu ou le matériel ne sont pas diffamatoires). Vous acceptez d'indemniser <strong>Kalisso</strong> en cas d'action d'un tiers contre <strong>Kalisso</strong> en lien avec le contenu ou le matériel que vous avez fourni, sauf dans le cas où l'éventuelle responsabilité <strong>Kalisso</strong> pourrait être recherchée pour ne pas avoir retiré un contenu dont le caractère illicite lui aurait été notifié (Formulaire de Notification), dès lors que cette action aurait pour cause, fondement ou origine le contenu que vous nous avez communiqué.
          <br>
          9. REVENDICATIONS DE PROPRIETE INTELLECTUELLE
          <br>
          <strong>Kalisso</strong> respecte la propriété intellectuelle d'autrui. Si vous pensez qu'un de vos droits de propriété intellectuelle a été utilisé d'une manière qui puisse faire naitre une crainte de violation desdits droits, merci de suivre notre Procédure et formulaire de notification de violation de droits.
          <br>
          10. CONDITIONS LOGICIEL <strong>Kalisso</strong>
          <br>
          S'ajoute à ces Conditions d'Utilisation, les conditions suivantes qui s'appliquent à tous les logiciels (en ce compris les mises à jour ou les évolutions du logiciel et de toute la documentation liée) que nous vous rendons disponibles pour votre utilisation des Services <strong>Kalisso</strong> (ci-après « Logiciels <strong>Kalisso</strong> »).
          <br>
          11. AUTRES ENTREPRISES
          <br>
          Des tiers autres qu'<strong>Kalisso</strong> gèrent des boutiques, proposent des services et vendent des lignes de produits sur ce site internet. De surcroit, nous fournissons des liens vers des sites internet de société affiliées et d'un certain nombre d'entreprises. Nous ne sommes pas responsables de l'examen ou de l'évaluation, et nous ne garantissons pas les offres de ces entreprises ou de ces particuliers, ou le contenu de leurs sites internet. <strong>Kalisso</strong> n'assume aucune responsabilité ou obligation pour les actes, produits ou contenu de ces entreprises ou de ces particuliers ou d'autres tiers. Vous êtes informés quand un tiers est impliqué dans votre transaction, et nous pouvons partager vos informations en lien avec cette transaction avec ce tiers. Vous devez examiner leurs politiques de confidentialité et autres conditions d'utilisation avec attention.
          <br>
          12. ROLE <strong>Kalisso</strong>
          <br>
          <strong>Kalisso</strong> permet à des vendeurs tiers de lister et de vendre leurs produits sur <strong>Kalisso</strong>.com. Dans chacun de ces cas, ceci est indiqué sur la page respective de détail du produit. Bien qu'<strong>Kalisso</strong>, en tant qu'hébergeur, facilite les transactions réalisées sur la place de marché (ou Marketplace) <strong>Kalisso</strong>, <strong>Kalisso</strong> n'est ni l'acheteur ni le vendeur des produits des vendeurs tiers. <strong>Kalisso</strong> fournit un lieu de rencontre dans lequel les acheteurs et vendeurs complètent et finalisent leurs transactions. En conséquence, pour la vente de ces produits de vendeurs tiers, un contrat de vente est formé uniquement entre l'acheteur et le vendeur tiers. <strong>Kalisso</strong> n'est pas partie à un tel contrat et n'assume aucune responsabilité ayant pour origine un tel contrat ou découlant de ce contrat de vente. <strong>Kalisso</strong> n'est ni l'agent ni le mandataire des vendeurs tiers. Le vendeur tiers est responsable des ventes de produits et des réclamations ou tout autre problème survenant ou lié au contrat de vente entre lui et l'acheteur. Parce qu'<strong>Kalisso</strong> souhaite que l'acheteur bénéficie d'une expérience d'achat la plus sûre, <strong>Kalisso</strong> offre la Garantie A à Z en plus de tout droit contractuel ou autre.
          <br>
          13. NOTRE RESPONSABILITE
          <br>
          Nous ferons de notre mieux pour assurer la disponibilité des Services <strong>Kalisso</strong> et que les transmissions se feront sans erreurs. Toutefois, du fait de la nature d'internet, ceci ne peut être garanti. De plus, votre accès aux Services <strong>Kalisso</strong> peut occasionnellement être suspendu ou limité pour permettre des réparations, la maintenance, ou ajouter une nouvelle fonctionnalité ou un nouveau service. Nous nous efforcerons de limiter la fréquence et la durée de ces suspensions ou limitations.
          <br>
          Dans le cadre de ses relations avec des professionnels, <strong>Kalisso</strong> n'est pas responsable (i) des pertes qui n'ont pas été causées par une faute de notre part, ou (ii) des pertes commerciales (y compris les pertes de profit, bénéfice, contrats, économies espérées, données, clientèle ou dépenses superflues), ou (iii) toute perte indirecte ou consécutive qui n'étaient pas prévisibles par vous et nous quand vous avez commencé à utiliser le Service <strong>Kalisso</strong>.
          <br>
          Nous ne serons pas tenus pour responsables des délais ou de votre impossibilité à respecter vos obligations en application de ces conditions si le délai ou l'impossibilité résulte d'une cause en dehors de notre contrôle raisonnable. Cette condition n'affecte pas votre droit légal de recevoir les produits envoyés et les services fournis dans un temps raisonnable ou de recevoir un remboursement si les produits ou les services commandés ne peuvent être délivrés dans un délai raisonnable en raison d'une cause hors de notre contrôle raisonnable.
          <br>
          Les lois de certains pays ne permettent pas certaines des limitations énumérées ci-dessus. Si ces lois vous sont applicables, tout ou partie de ces limitations ne vous sont pas applicables, et vous pouvez disposer de droits supplémentaires.
          <br>
          Rien dans ces conditions ne vise à limiter ou n'exclure notre responsabilité en cas de dol, ou en cas de décès ou de préjudice corporel causé(e) par notre négligence ou une faute lourde.
          <br>
          14. DROIT APPLICABLE
          <br>
          Les présentes Conditions d'utilisation sont soumises au droit luxembourgeois (à l'exception de ses dispositions concernant les conflits de loi), et l'application de la Convention de Vienne sur les contrats de vente internationale de marchandises est expressément exclue. Si vous êtes un consommateur et que votre résidence habituelle est située dans un pays de l'Union Européenne, vous bénéficiez également de droits vous protégeant en vertu des dispositions obligatoires de la loi applicable dans votre pays de résidence. Vous, comme nous, acceptons de soumettre tous les litiges occasionnés par la relation commerciale existant entre vous et nous à la compétence non exclusive des juridictions de la ville de Luxembourg, ce qui signifie que pour l'application des présentes Conditions d'utilisation, vous pouvez intenter une action pour faire valoir vos droits de consommateur, au Luxembourg ou dans le pays de l'Union Européenne dans lequel vous résidez. La Commission Européenne met à disposition une plateforme en ligne de résolution des différends à laquelle vous pouvez accéder ici: https://ec.europa.eu/consumers/odr/ . Si vous souhaitez attirer notre attention sur un sujet, merci de nous contacter.
          15. MODIFICATION DU SERVICE OU DES CONDITIONS D'UTILISATION
          <br>
          Nous nous réservons le droit de faire des modifications sur tout Service <strong>Kalisso</strong>, à nos procédures, à nos termes et conditions, y compris les présentes Conditions d'utilisation à tout moment. Vous êtes soumis aux termes et conditions, procédures et Conditions d'utilisation en vigueur au moment où vous utilisez le Service <strong>Kalisso</strong>. Si une stipulation de ces Conditions d'utilisation est réputée non valide, nulle, ou inapplicable, quelle qu'en soit la raison, cette stipulation sera réputée divisible et n'affectera pas la validité et l'opposabilité des stipulations restantes.
          <br>
          16. RENONCIATION
          <br>
          Si vous enfreignez ces Conditions d'utilisation et que nous ne prenons aucune action, nous serions toujours en droit d'utiliser nos droits et voies de recours dans toutes les autres situations où vous violeriez ces Conditions d'utilisation.
          <br>
          17. MINEURS
          <br>
          Nous ne vendons pas de produits aux mineurs. Nous vendons des produits pour enfants pour des achats par des adultes. Si vous avez moins de 18 ans, vous ne pouvez utiliser un Service <strong>Kalisso</strong> que sous la surveillance d'un parent ou d'un tuteur. Les offres de produits contenant de l'alcool sont destinées à des personnes majeures. Vous devez avoir au moins 18 ans pour acheter de l'alcool ou utiliser toute fonctionnalité du site concernant de l'alcool.
          <br>
          18. NOS COORDONNEES
          <br>
          Le site internet <strong>Kalisso</strong>.com appartient à, et sa maintenance est effectuée par, <strong>Kalisso</strong> Afrique SARL. Des conditions spécifiques d'utilisation et de vente pour d'autres Services <strong>Kalisso</strong>, par exemple le service Musique MP3 géré par <strong>Kalisso</strong> Media EU SARL, peuvent être trouvées sur le site internet.
          <br>
          Pour <strong>Kalisso</strong> Afrique SARL :
          <br>
          <strong>Kalisso</strong> Afrique SARL, Société à responsabilité limitée, 38 avenue John F. Kennedy, L-1855 Luxembourg
          Capital social : 37 500 €
          Enregistrée au Luxembourg
          RCS Luxembourg N° : B-101818
          Numéro de licence : 10040783
          Numéro de TVA intracommunautaire : LU 26375245
          <br>
          Autres coordonnées :
          <br>
          Pour <strong>Kalisso</strong> EU SARL :
          <strong>Kalisso</strong> EU SARL, Société à responsabilité limitée, 38 avenue John F. Kennedy, L-1855 Luxembourg
          Capital social : 125 000 €
          Enregistrée au Luxembourg
          RCS Luxembourg N° : B-101818
          Numéro de licence : 134248
          Numéro de TVA intracommunautaire : LU 20260743
          <br>
          Succursale en France :
          <strong>Kalisso</strong> EU SARL, succursale française, 67 Boulevard du General Leclerc, Clichy 92110, France
          Enregistrée en France
          Immatriculation au RCS, numéro : 487773327 R.C.S. Nanterre
          Numéro de TVA intracommunautaire : FR 12487773327
          <br>
          Pour <strong>Kalisso</strong> Services Afrique SARL :
          <strong>Kalisso</strong> Services Afrique SARL, Société à responsabilité limitée, 38 avenue John F. Kennedy, L-1855 Luxembourg
          Capital social : 37 500 €
          Enregistrée au Luxembourg
          RCS Luxembourg N°: B-93815
          Numéro de licence : 132595
          Numéro de TVA intracommunautaire : LU 19647148
          <br>
          Pour <strong>Kalisso</strong> Media EU SARL :
          <strong>Kalisso</strong> Media EU SARL, Société à responsabilité limitée, 38 avenue John F. Kennedy, L-1855 Luxembourg
          Capital social : 37 500 €
          Enregistrée au Luxembourg
          RCS Luxembourg N°: B-112767
          Numéro de licence : 136312
          Numéro de TVA intracommunautaire : LU 20944528
          <br>
          19. PROCEDURE ET FORMULAIRE DE NOTIFICATION DE VIOLATION DE DROITS
          <br>
          Si vous pensez que vos droits ont été violés et que vous êtes éligible aux Registre des Marques, veuillez vous inscrire au service et soumettre votre plainte via le Registre des Marques. Sinon, merci d'utiliser notre Formulaire de Notification. Ce formulaire peut être utilisé pour nous soumettre toute sorte de plainte de propriété intellectuelle y compris, sans toutefois s'y limiter, les plaintes liées aux droits d'auteur, de marques, de dessins et modèles et de brevets. Dès réception d'un Formulaire de Notification, nous pouvons prendre certaines mesures, notamment la suppression d'informations ou d'un article et mettre fin aux infractions répétées dans des circonstances appropriées. Ces mesures seront toutefois prises sous toutes réserves, sans reconnaissance de notre part d'une responsabilité quelconque et sans préjudice de l'exercice de nos droits, actions et moyens de défense. Ceci comprend également le transfert de ce formulaire aux parties concernées par l'infraction alléguée. Vous acceptez d'indemniser <strong>Kalisso</strong> contre toute réclamation de tiers contre <strong>Kalisso</strong>, découlant de, ou dans le cadre de cette notification.
          <br>
          Note concernant les offres des vendeurs tiers : merci de garder à l'esprit que les offres des vendeurs tiers sont seulement hébergées sur <strong>Kalisso</strong>.com et sont publiées uniquement sous la direction des vendeurs tiers qui peuvent être contactés par leur page « Informations sur le vendeur », accessible depuis toutes leurs offres.
          <br>
          Définition d'ASIN et de ISBN-10 : « ASIN » signifie <strong>Kalisso</strong> Standard Item (or Identification) Number (Numéro d'identification ou d'article standard <strong>Kalisso</strong>) et est un identifiant composé de dix (10) caractères. Ce numéro figure dans toute fiche descriptive d'un produit sous le titre « Détails sur le produit ». « ISBN-10 » signifie International Standard Book Number (Numéro de livre standard international) et est un identifiant composé de dix (10) chiffres figurant sur certaines fiches descriptives de livres dans la catégorie « Détails sur le produit ».
          <br>
          Avertissement important : fournir des informations inexactes, trompeuses ou fausses dans un Formulaire de Notification adressé à <strong>Kalisso</strong> engage sa responsabilité civile et/ou pénale. En cas de doute, veuillez contacter un conseiller juridique..
          <br>
          Formulaire de notification : Si vous souhaitez nous notifier la violation de vos droits en relation avec une offre de produit disponible sur le site www.<strong>Kalisso</strong>.com, nous vous invitons à remplir le Formulaire de notification disponible en cliquant sur le lien ci-dessous :
          <br>
          Formulaire de Notification
          <br>
          20. PROCEDURE ET FORMULAIRE DE NOTIFICATION EN VUE DE NOTIFIER UN CONTENU INJURIEUX OU DIFFAMATOIRE
          <br>
          Parce que des millions de produits sont listés et que des milliers de commentaires sont hébergés sur <strong>Kalisso</strong>.com, il ne nous est pas possible de connaître le contenu de tous les produits offerts à la vente, ou de tous les commentaires ou critiques qui sont affichés. En conséquence, nous opérons sous un système de « notice and action » soit « notifier et action ». Si vous pensez qu'un contenu ou une annonce de vente sur le site internet contient un message diffamatoire, merci de nous le notifier immédiatement en complétant la Procédure et le Formulaire de notification en vue de notifier un contenu injurieux ou diffamatoire. Suivez les instructions dans le formulaire de la Notification.
          <br>
          Avertissement important : fournir des informations inexactes, trompeuses ou fausses dans la Notification adressée à <strong>Kalisso</strong> peut engager votre responsabilité civile et/ou pénale.
          <br>
          La procédure de notification : Merci de nous envoyer le formulaire ci-dessous, dûment rempli et signé, à l'adresse suivante : Département juridique, NTD, <strong>Kalisso</strong> EU S.à r.l., 38 avenue John F. Kennedy, L-1855 Luxembourg, Grand Duché du Luxembourg.
          <br>
          Formulaire de notification :
          <br>
          D E C L A R A T I O N
          <br>
          Je soussigné,
          Nom et prénom : ____________________________________________________________________________
          Nom Société : ______________________________________________________________________________
          Adresse et Adresse e-mail : ___________________________________________________________________
          Numéro de téléphone (SUR LEQUEL VOUS POUVEZ ETRE JOINT DURANT LA JOURNEE) : ___________________________
          <br>
          Déclare sur l'honneur ce qui suit :
          1. Je fais référence au site www.<strong>Kalisso</strong>.com. Ce dernier affiche ou contribue à l'affichage de commentaires injurieux ou diffamatoires à mon sujet.
          <br>
          2. Les propos injurieux ou diffamatoires (RAYEZ LE PARAGRAPHE INUTILE) :
          (a) apparaissent dans un livre vendu sur le site www.<strong>Kalisso</strong>.com :
          <br>
          Titre du livre et auteur :______________________________________________________________
          Numéro ASIN (1) ou ISBN-13 (2) du livre : ____________________________________________________
          Numéro(s) de la (des) page(s) qui comporterai(en)t des propos diffamatoires : <br>__________________________________________________________________________________
          (b) apparaissent sur le site www.<strong>Kalisso</strong>.com à l'adresse suivante: _______________________ (ADRESSE EXACTE DE LA PAGE WEB)<br>
          (b.1.) Les propos que je considère comme INJURIEUX sont les suivants (VEUILLEZ REPRODUIRE LES PROPOS EXACTS DONT VOUS VOUS PLAIGNEZ) :<br>
          _________________________________________________________________________________________
          (b.2.) Ces propos sont injurieux car (VEUILLEZ EXPLIQUER LA RAISON POUR LAQUELLE VOUS CONSIDEREZ CES PROPOS COMME INJURIEUX) :<br><br>
          _________________________________________________________________________________________
          (b.3.) Les propos que je considère commeDIFFAMATOIRES sont les suivants (VEUILLEZ REPRODUIRE LES PROPOS EXACTS DONT VOUS VOUS PLAIGNEZ) :<br>
          _____________________________________________________________________________________
          (b.4.) Ces propos sont diffamatoires car (VEUILLEZ EXPLIQUER LA RAISON POUR LAQUELLE VOUS CONSIDEREZ CES PROPOS COMME DIFFAMATOIRES) :<br>
          _____________________________________________________________________________________
          <br><br><br>
          3. Je reconnais que la présente déclaration peut être produite au cours de toute procédure judiciaire découlant des, ou dans le cadre des, propos injurieux et diffamatoires contre lesquels je porte plainte.
          <br><br>
          Déclaration de vérité
          Je déclare que les faits déclarés ci-dessus sont exacts.
          <br><br>
          Signature, Lieu, Date: _____________________________ __________________________________
          <br><br>
          (1) « ASIN » signifie « <strong>Kalisso</strong> Standard Item (or Identification) Number » (Numéro d'identification ou d'article standard <strong>Kalisso</strong>) et représente un identifiant propre à <strong>Kalisso</strong>.com composé de dix (10) caractères. Ce numéro figure dans toute fiche descriptive d'un produit sous le titre « Détails sur le produit ».
          <br><br>
          (2) « ISBN-10 » signifie « International Standard Book Number » (Numéro de livre standard international) et est un identifiant composé de dix (10) chiffres figurant sur certaines fiches descriptives de livres dans la catégorie « Détails sur le produit ».
          <br><br>
          CONDITIONS ADDITIONNELLES DES LOGICIELS <strong>Kalisso</strong>
          <br>
          1. Utilisation des Logiciels <strong>Kalisso</strong>.
          <br><br>
          Vous pouvez utiliser les Logiciels <strong>Kalisso</strong> aux seules fins de vous permettre d'utiliser et de profiter des Services <strong>Kalisso</strong> tels que fournis par <strong>Kalisso</strong>, et tels qu'autorisé par les Conditions d'utilisation, des présentes Conditions Logiciel <strong>Kalisso</strong>, et des Conditions des Services. Il est interdit d'intégrer tout ou partie d'un Logiciel <strong>Kalisso</strong> dans vos propres programmes, de compiler tout ou partie d'un Logiciel <strong>Kalisso</strong> avec vos propres programmes, de transférer tout ou partie d'un Logiciel <strong>Kalisso</strong> pour l'utiliser avec un autre service ou de vendre, louer, prêter, distribuer ou sous-licencier tout ou partie d'un Logiciel <strong>Kalisso</strong> ou transférer un quelconque droit sur tout ou partie de ce Logiciel <strong>Kalisso</strong>. Vous ne pouvez utiliser les Logiciels <strong>Kalisso</strong> à des fins illégales. Nous nous réservons le droit de mettre fin à toute utilisation d'un Logiciel <strong>Kalisso</strong> et de vous retirer les droits d'utilisation d'un Logiciel <strong>Kalisso</strong> à tout moment. Si vous ne respectez pas les présentes Conditions Logiciel <strong>Kalisso</strong>, les Conditions d'utilisation et toutes Conditions des Services <strong>Kalisso</strong>, les droits d'utilisation d'un Logiciel <strong>Kalisso</strong> qui vous sont accordés vous seront automatiquement retirés sans notification préalable. Des conditions supplémentaires définies par des tiers et contenues ou distribuées avec certains Logiciels <strong>Kalisso</strong> et spécifiquement identifiées dans la documentation connexe peuvent être applicables à ces Logiciels <strong>Kalisso</strong> (ou logiciels intégrés dans un Logiciel <strong>Kalisso</strong>) et prévaudront en cas de conflit avec les présentes Conditions d'utilisation. Tout logiciel utilisé dans un quelconque Service <strong>Kalisso</strong> est la propriété <strong>Kalisso</strong> ou de ses fournisseurs de logiciels et est protégé par les lois luxembourgeoises et internationales sur la protection des programmes d'ordinateur et du copyright.
          <br>
          2. Utilisation de services tiers.
          <br>
          Lorsque vous utilisez un Logiciel <strong>Kalisso</strong>, vous pouvez également être amené à utiliser les services d'un ou plusieurs tiers, tels que ceux d'un opérateur mobile ou d'un fournisseur de plateforme mobile. L'utilisation de ces services tiers peut être soumise aux politiques, conditions d'utilisation et à des frais de ces tiers.
          <br>
          3. Interdiction d'ingénierie inverse.
          <br>
          Vous ne pouvez et vous n'encouragerez pas, ni n'assisterez ou n'autoriserez qui que ce soit à (i) copier, modifier, altérer d'une autre façon un Logiciel <strong>Kalisso</strong> en tout ou partie, créer des œuvres dérivées à partir ou du Logiciel <strong>Kalisso</strong> ou (ii) effectuer de l'ingénierie inverse, décompiler ou désassembler un Logiciel <strong>Kalisso</strong> en tout ou partie, sauf dans les limites autorisées par la loi.
          <br>
          4. Mises à jour.
          <br>
          Afin de garder les Logiciels <strong>Kalisso</strong> à jour, nous pouvons offrir des mises à jour automatiques ou manuelles à tout moment et sans notification préalable.
          <br>
          CONDITIONS GENERALES DE VENTE
          Bienvenue sur le site <strong>Kalisso</strong>.com.
          <br>
          <strong>Kalisso</strong> EU SARL et/ou ses sociétés affiliées (« <strong>Kalisso</strong> ») vous fournissent des fonctionnalités de site internet et d'autres produits et services quand vous visitez ou achetez sur le site internet <strong>Kalisso</strong>.com (le « Site Internet »), utilisez des produits et services <strong>Kalisso</strong>, utiliser des applications <strong>Kalisso</strong> pour mobile, ou utiliser des logiciels fournis par <strong>Kalisso</strong> dans le cadre de tout ce qui précède (ensemble ci-après, les « Services <strong>Kalisso</strong> »). <strong>Kalisso</strong> fournit les Services <strong>Kalisso</strong> selon les conditions définies dans cette page.
          <br>
          Ces Conditions Générales de Vente régissent la vente de produits entre <strong>Kalisso</strong> EU SARL et vous. Pour les conditions relatives à la vente entre vous et des vendeurs tiers sur le Site Internet <strong>Kalisso</strong>.com, veuillez prendre connaissance du Contrat <strong>Kalisso</strong> Services Afrique Business Solutions. Nous offrons un large panel de Services <strong>Kalisso</strong> et il se peut que des conditions additionnelles s'appliquent. Par ailleurs, lorsque vous utilisez un Service <strong>Kalisso</strong> (par exemple votre Profil, les Chèques-Cadeaux, les applications pour mobile ou le Gestionnaire de communication), vous êtes également soumis aux termes, lignes directrices et conditions applicables à ce Service <strong>Kalisso</strong> (les « Conditions du Service »). Si ces Conditions Générales de Ventes entrent en contradiction avec les Conditions du Service, les Conditions du Service prévaudront.
          <br>
          Merci de lire ces conditions attentivement avant d'effectuer une commande avec <strong>Kalisso</strong> EU SARL. En commandant avec <strong>Kalisso</strong> EU SARL, vous nous notifiez votre accord d'être soumis aux présentes conditions.
          <br>
          1. COMMENT COMMANDER
          <br>
          Si vous souhaitez acheter un ou plusieurs produit(s) figurant sur le Site Internet, vous devez sélectionner chaque produit que vous souhaitez acheter et l'ajouter à votre panier. Lorsque vous avez sélectionné tous les produits que vous voulez acheter, vous pouvez confirmer le contenu de votre panier et passer la commande.
          <br>
          A ce stade, vous serez redirigé vers une page récapitulant les détails des produits que vous avez sélectionnés, leur price et les options de livraisons (avec les frais de livraison concernés). Vous devrez alors choisir les options de livraison ainsi que les méthodes d'envoi et de paiement qui vous conviennent le mieux.
          <br>
          En haut de cette page, se situe le bouton d'achat. Vous devez cliquer sur ce bouton pour confirmer et passer votre commande.
          <br>
          Après avoir passé votre commande, nous vous adressons un message de confirmation. Si vous utilisez certains Services <strong>Kalisso</strong> (tels que les Applications <strong>Kalisso</strong> pour mobile), le message de confirmation pourra être envoyé via le Gestionnaire de communication sur le site. Nous vous informons de l'envoi de vos articles. Vous avez néanmoins la possibilité de modifier votre commande jusqu'à la date d'envoi de vos articles.
          <br>
          Veuillez noter que nous vendons des produits seulement en quantités correspondant aux besoins moyens habituels d'un foyer. Ceci s'applique aussi bien au nombre de produits commandés dans une seule commande qu'au nombre de commandes individuelles respectant la quantité habituelle d'un foyer normal passées pour le même produit. <strong>Kalisso</strong> ne vend pas aux bibliothèques de prêt.
          <br>
          Vous acceptez d'obtenir les factures de vos achats par voie électronique. Les factures électroniques seront mises à votre disposition au format .pdf dans l'espace Votre compte sur notre Site Internet. Pour chaque livraison, nous vous indiquerons dans le message de confirmation d'envoi si une facture électronique est disponible. Pour plus d'informations sur les factures électroniques et pour savoir comment recevoir une copie papier, merci de consulter nos pages d'Aide.
          <br>
          2. DROIT DE RETENTION
          <br>
          Les produits livrés restent la propriété <strong>Kalisso</strong> jusqu'à leur remise au transporteur.
          <br>
          3. DROIT DE RETRACTATION DE 14 JOURS, EXCEPTIONS AU DROIT DE RETRACTATION, NOTRE POLITIQUE DE RETOURS SOUS 30 JOURS
          <br>
          DROIT LEGAL DE RETRACTATION
          <br>
          A moins que l'une des exceptions listées ci-dessous ne soit applicable, vous pouvez vous rétracter de votre commande sans donner de motif dans un délai de 14 jours courant à compter de la date à laquelle vous-même, ou un tiers désigné par vous (autre que le transporteur), a pris physiquement possession des biens achetés (ou du dernier bien, lot ou pièce si le contrat porte sur la livraison de plusieurs biens ou plusieurs lots ou pièces livrés séparément) ou de la date à laquelle vous avez conclu le contrat pour les prestations de services.
          <br>
          Vous devez nous notifier (<strong>Kalisso</strong> EU Sarl, 38 avenue John F. Kennedy, L-1855 Luxembourg) votre décision de vous rétracter de votre commande. Vous pouvez soumettre votre demande en ligne conformément aux instructions et formulaires disponibles auprès de notre centre de retours en ligne, en utilisant ce formulaire, ou par courrier. Dans le cas où vous utiliseriez le Centre de retours en ligne, nous vous enverrons un accusé de réception.
          <br>
          Pour respecter la date limite de rétractation, il vous suffit d'envoyer votre demande de rétractation avant que le délai de 14 jours n'expire et de renvoyer votre produit par le biais de notre centre de retours en ligne.
          <br>
          Pour toute information complémentaire sur l'étendue, le contenu et les instructions quant à l'exercice de votre droit de rétractation, merci de contacter notre Service Client.
          <br>
          EFFETS DE LA RETRACTATION
          <br>
          Nous vous rembourserons tous les paiements que nous avons reçus de votre part, y compris les frais de livraison standards (c'est-à-dire correspondant à la livraison la moins onéreuse que nous proposons) au plus tard 14 jours à compter de la réception de votre demande de rétractation. Nous utiliserons le même moyen de paiement que celui que vous avez utilisé lors de votre commande initiale, sauf si vous convenez expressément d'un moyen différent. En tout état de cause, ce remboursement n'occasionnera pas de frais supplémentaires pour vous. Nous pouvons différer le remboursement jusqu'à ce que nous ayons reçu le(s) produit(s) ou jusqu'à ce que vous ayez fourni une preuve d'expédition du (des) produit(s), la date retenue étant celle du premier de ces faits. Si le remboursement intervient après la date limite mentionnée ci-dessus, le montant qui vous est dû sera augmenté de plein droit.
          <br>
          Veuillez noter que vous devez renvoyer le(s) produit(s) en suivant les instructions disponibles sur notre centre de retours en ligne au plus tard 14 jours à compter de la date à laquelle vous nous avez notifié votre décision de rétractation.
          <br><br>
          Vous devez prendre à votre charge les frais directs de renvoi du (des) produit(s). Vous serez responsable de la dépréciation de la valeur du(s) produit(s) résultant de manipulations (autres que celles nécessaires pour établir la nature, les caractéristiques et le bon fonctionnement de ce(s) produit(s))
          <br><br>
          EXCEPTIONS AU DROIT DE RETRACTATION
          <br><br>
          Le droit de rétractation ne s'applique pas à :
          la livraison de produits qui ne peuvent pas être retournés pour des raisons d'hygiène ou de protection de la santé, si vous les avez descellés ou bien, qui ont, après avoir été livrés, été mélangés de manière indissociables avec d'autres articles ;
          la livraison d'enregistrements audio ou vidéos ou de logiciels informatiques lorsque vous les avez descellés après la livraison ;
          la livraison de produits qui ont été confectionnés selon vos spécifications ou nettement personnalisés ;
          la fourniture de produits susceptibles de se détériorer ou de se périmer rapidement ;
          la fourniture de services pleinement exécutés par <strong>Kalisso</strong> pour lesquels vous avez accepté au moment de la passation de votre commande que nous commencions leur exécution, et renoncé à votre droit de rétractation ;
          la fourniture de journaux, périodiques ou magazines à l'exception des contrats d'abonnement à ces publications ; et
          la fourniture de boissons alcoolisées dont la valeur convenue à la conclusion du contrat dépend de fluctuation sur le marché échappant à notre contrôle.<br><br>
          NOTRE POLITIQUE DE RETOURS SOUS 30 JOURS
          <br><br>
          Sans préjudice des droits qui vous sont reconnus par la loi, <strong>Kalisso</strong> vous propose la politique de retours suivante :
          <br>
          Tous les produits en provenance des sites <strong>Kalisso</strong> peuvent être retournés dans les 30 jours suivant la réception des produits par <strong>Kalisso</strong> si les produits sont complets et dans un état neuf et intact. S'agissant des supports de données emballés sous plastique ou scellés (par exemple, les CDs, cassettes audio, vidéos VHS, DVD, jeux PC, jeux vidéo et logiciels, articles de la boutique Hygiène, Beauté et Santé Animale), nous ne les reprendrons que s'ils sont toujours dans leur emballage plastique ou qu'ils n'ont pas été descellés. Les produits doivent être retournés par le biais de notre Centre de retours en ligne. Cette politique de retours n'est pas applicable aux contenus numériques ou logiciels informatiques qui ne sont pas fournis sur un support matériel (ex : sur un CD ou un DVD).
          <br>
          Si vous renvoyez un (des) produit(s) conformément à notre politique de retour, nous vous rembourserons le price que vous avez payé mais pas les frais de livraison de votre achat initial. De même, les risques liés au transport et les frais de livraison de retour seront à votre charge. Les frais de livraison et de retour ne sont remboursés que pour les vêtements et les chaussures achetés sur l'un de nos sites. Cette politique de retours n'affecte pas vos droits reconnus par la loi, y compris votre droit légal de rétractation décrit ci-dessus.
          <br>
          Plus de détails sur notre politique de retours sont disponibles ici.
          <br>
          Vous bénéficiez par ailleurs des garanties légales de conformité et des vices cachés mentionnées à l'article 7 des présentes Conditions Générales de Vente (« Notre responsabilité Garanties »).
          <br><br>
          4. PRIX ET DISPONIBILITE
          <br>
          Tous les price sont toutes taxes françaises comprises (TVA française et autres taxes applicables) sauf indication contraire.
          <br>
          Nous affichons la disponibilité des produits que nous vendons sur le Site Internet sur chaque fiche produit. Nous ne pouvons apporter plus de précision concernant la disponibilité des produits que ce qui est indiqué sur ladite page ou ailleurs sur le Site Internet. Lors du traitement de votre commande, nous vous informerons dès que possible par courrier électronique en utilisant l'adresse associée à votre abonnement ou via le Gestionnaire de communication dans Votre compte, si des produits que vous avez commandés s'avèrent être indisponibles, et nous ne vous facturerons pas ces produits.
          <br>
          En dépit de tous nos efforts, un petit nombre des produits présents dans notre catalogue peuvent afficher une erreur sur le price. Nous vérifierons le price au moment du traitement de votre commande et avant tout paiement. S'il s'avérait que nous avons fait une erreur sur l'affichage du price, et que le price réel est supérieur au price affiché sur le Site Internet, nous pouvons vous contacter pour vous demander si vous souhaitez acheter le produit à son price réel ou si vous préférez annuler votre commande. Si le price réel est inférieur au price affiché, nous vous facturerons le montant le plus bas et nous vous enverrons le produit.
          <br>
          5. DOUANES
          <br>
          Lorsque vous commandez des produits sur <strong>Kalisso</strong> pour être livrés en dehors de l'Union Européenne, vous pouvez être soumis à des obligations et des taxes sur l'importation, qui sont perçues lorsque le colis arrive à destination. Tout frais supplémentaire de dédouanement sera à votre charge ; nous n'avons aucun contrôle sur ces frais. Les politiques douanières varient fortement d'un pays à l'autre, vous devez donc contacter le service local des douanes pour plus d'informations. Par ailleurs, veuillez noter que lorsque vous passez commande sur <strong>Kalisso</strong>, vous êtes considéré comme l'importateur officiel et devez respecter toutes les lois et règlements du pays dans lequel vous recevez les produits. La protection de votre vie privée est importante pour nous et nous attirons l'attention de nos clients internationaux sur le fait que les livraisons transfrontalières sont susceptibles d'être ouvertes et inspectées par les autorités douanières. Pour plus d'informations, consultez la page Informations douanières.
          <br>
          6. COMMANDE 1-CLICK

          La commande en 1-Click est la façon la plus rapide et la plus simple pour commander des produits en toute sécurité sur le site. Si vous utilisez un ordinateur public ou partagé, nous vous recommandons fortement de désactiver la commande 1-Click quand vous n'êtes pas devant l'ordinateur.

          7. NOTRE RESPONSABILITE - GARANTIES

          Vous bénéficiez de la garantie légale de conformité dans les conditions des articles L.217-4 et suivants du code de la consommation et de la garantie des vices cachés dans les conditions prévues aux articles 1641 et suivants du code civil. Pour plus d'informations sur ces garanties, rendez-vous ici.

          Lorsque vous agissez en garantie légale de conformité,

          vous bénéficiez d'un délai de deux ans à compter de la délivrance du bien pour agir ;
          vous pouvez choisir entre la réparation ou le remplacement du bien, sous réserve des conditions de coût prévues par l'article L.217-9 du code de la consommation ;
          pour tout produit acheté jusqu'au 17 mars 2016 à 23:59:59, vous êtes dispensés de rapporter la preuve de l'existence du défaut de conformité du bien durant les six (6) mois suivant la délivrance du bien ;
          pour tout produit acheté à partir du 18 mars 2016 à minuit, vous êtes dispensés de rapporter la preuve de l'existence du défaut de conformité du bien durant les vingt-quatre (24) mois suivant la délivrance du bien, sauf pour les biens d'occasion pour lesquels vous êtes dispensés de rapporter la preuve de l'existence du défaut de conformité du bien seulement durant les six (6) mois suivant la délivrance du bien.
          La garantie légale de conformité s'applique indépendamment de la garantie commerciale éventuellement consentie.

          Vous pouvez décider de mettre en œuvre la garantie des vices cachés au sens de l'article 1641 du code civil. Dans cette hypothèse, vous pouvez choisir entre la résolution de la vente ou une réduction du price de vente (article 1644 du code civil).

          Les produits audio, vidéo et multimédia peuvent donner droit à la garantie du fabricant indiquée sur la fiche détaillée du produit. Si le produit devient défectueux pendant la période de la garantie du fabricant, vous pouvez consulter le service après-vente du fabricant.

          A l'exception des livraisons en France et au Luxembourg, nous déclinons toute responsabilité dans l'hypothèse où l'article livré ne respecterait pas la législation du pays de livraison.

          Nous nous engageons à apporter tous les soins en usage dans la profession pour la mise en œuvre du service offert au client. Néanmoins, notre responsabilité ne pourra pas être retenue en cas de retard ou de manquement à nos obligations contractuelles si le retard ou manquement est dû à une cause en dehors de notre contrôle : cas fortuit ou cas de force majeure tel que défini par la loi applicable.

          Notre responsabilité ne sera pas engagée en cas de retard dû à une rupture de stock chez l'éditeur ou chez le fournisseur. En outre, notre responsabilité ne sera pas engagée en cas de différences mineures entre les photos de présentation des articles et les textes affichés sur le Site Internet <strong>Kalisso</strong>.com, et les produits livrés.

          Nous mettons en œuvre tous les moyens dont nous disposons pour assurer les prestations objets des présentes Conditions Générales de Vente. Nous sommes responsables de tout dommage direct et prévisible au moment de l'utilisation du Site Internet ou de la conclusion du contrat de vente entre nous et vous. Dans le cadre de nos relations avec des professionnels, nous n'encourrons aucune responsabilité pour les pertes de bénéfices, pertes commerciales, pertes de données ou manque à gagner ou tout autre dommage indirect ou qui n'était pas prévisible au moment de l'utilisation du Site Internet ou de la conclusion du contrat de vente entre nous et vous.

          La limitation de responsabilité visée ci-dessus est inapplicable en cas de dol ou de faute lourde de notre part, en cas de dommages corporels ou de responsabilité du fait des produits défectueux, en cas d'éviction et en cas de non-conformité (y compris en raison de vices cachés).

          8. DROIT APPLICABLE

          Les présentes Conditions d'utilisation sont soumises au droit luxembourgeois (à l'exception de ses dispositions concernant les conflits de loi), et l'application de la Convention de Vienne sur les contrats de vente internationale de marchandises est expressément exclue. Vous, comme nous, acceptons de soumettre tous les litiges occasionnés par la relation commerciale existant entre vous et nous à la compétence non exclusive des juridictions de la ville de Luxembourg, ce qui signifie que pour l'application des présentes Conditions Générales de Vente, vous pouvez intenter une action pour faire valoir vos droits de consommateur, au Luxembourg ou dans le pays de l'Union Européenne dans lequel vous résidez. Si vous êtes un consommateur et que votre résidence habituelle est située dans un pays de l'Union Européenne, vous bénéficier également de droits vous protégeant en vertu des dispositions obligatoires de la loi applicable dans votre pays de résidence.

          Notre entreprise adhère à la Fédération du e-commerce et de la vente à distance (FEVAD) et au service de médiation du e-commerce (60 rue la Boétie, 75008 Paris) – relationconso@fevad.com.

          La Commission Européenne met à disposition une plateforme en ligne de résolution des différends à laquelle vous pouvez accéder ici: https://ec.europa.eu/consumers/odr/. Si vous souhaitez attirer notre attention sur un sujet, merci de nous contacter.

          9. MODIFICATION DU SERVICE OU DES CONDITIONS GENERALES DE VENTE

          Nous nous réservons le droit de faire des changements à notre Site Internet, nos procédures, et à nos termes et conditions, y compris les présentes Conditions Générales de Vente à tout moment. Vous êtes soumis aux termes et conditions, procédures et Conditions Générales de Vente en vigueur au moment où vous nous commandez un produit, sauf si un changement à ces termes et conditions, ou les présentes Conditions Générales de Vente est exigé par une autorité administrative ou gouvernementale (dans ce cas, cette modification peut s'appliquer aux commandes antérieures que vous avez effectuées). Si l'une des stipulations de ces Conditions Générales de Vente est réputée non valide, nulle ou inapplicable, quelle qu'en soit la raison, cette stipulation sera réputée divisible et n'affectera pas la validité et l'effectivité des stipulations restantes.

          10. RENONCIATION

          Si vous enfreignez ces Conditions Générales de Vente et que nous ne prenons aucune action, nous serions toujours en droit d'utiliser nos droits et voies de recours dans toutes les autres situations où vous violeriez ces Conditions Générale de Vente.

          11. MINEURS

          Nous ne vendons pas de produits aux mineurs. Nous vendons des produits pour enfants pour des achats par des adultes. Si vous avez moins de 18 ans, vous ne pouvez utiliser le Site Internet <strong>Kalisso</strong>.com que sous la surveillance d'un parent ou d'un tuteur.

          12. IDENTIFICATION

          <strong>Kalisso</strong>.com est une marque commerciale utilisée par <strong>Kalisso</strong> EU SARL. Nos informations de contact sont les suivantes :

          <strong>Kalisso</strong> EU SARL, Société à responsabilité limitée, 38 avenue John F. Kennedy, L-1855 Luxembourg
          Capital social : 125.000 €
          Enregistrée au Luxembourg
          RCS Luxembourg N° : B-101818
          Numéro de licence : 134248
          Numéro de TVA intracommunautaire : LU 20260743

          Succursale en France :
          <strong>Kalisso</strong> EU SARL, succursale française, 67 Boulevard du General Leclerc, Clichy 92110, France
          Enregistrée en France
          Immatriculation au RCS, numéro : 487773327 R.C.S. Nanterre
          Numéro de TVA intracommunautaire : FR 12487773327

          Liste non exhaustive des marques déposées <strong>Kalisso</strong> :1-CLIC, 1-CLICK, 1-CLICK COMPARE, 1° SOUTH, 1° SOUTH Design, 6PM, 6 Design, 43 PLACES, 43 THINGS, a Design, A9, ABE, ABEBOOKS, ADMASH, <strong>Kalisso</strong> ADMASH Design,, ADZINIA, ALEXA, ALL CONSUMING, AMAPEDIA, <strong>Kalisso</strong>, <strong>Kalisso</strong> Design, <strong>Kalisso</strong>.CA, <strong>Kalisso</strong>.CO.JP, <strong>Kalisso</strong>.CO.UK, <strong>Kalisso</strong>.DE, <strong>Kalisso</strong>.ES, <strong>Kalisso</strong>.com, <strong>Kalisso</strong>.IT, <strong>Kalisso</strong>.ES, <strong>Kalisso</strong> ANYWHERE, <strong>Kalisso</strong> BASICS Design, <strong>Kalisso</strong> BOOKCLIPS PODCAST Design, <strong>Kalisso</strong>.COM, <strong>Kalisso</strong>.COM Design, <strong>Kalisso</strong>.COM ANYWHERE, <strong>Kalisso</strong>ASSIST, <strong>Kalisso</strong> CLOUDFRONT, <strong>Kalisso</strong>CONNECT, <strong>Kalisso</strong>CROSSING, <strong>Kalisso</strong> CURRENCY CONVERTER, <strong>Kalisso</strong> DEVPAY, <strong>Kalisso</strong> EC2, <strong>Kalisso</strong>E, <strong>Kalisso</strong>E Design, <strong>Kalisso</strong>FRESH, <strong>Kalisso</strong>FRESH Design, <strong>Kalisso</strong>.com AND YOU'RE DONE & Design, <strong>Kalisso</strong> FRUSTRATION-FREE, <strong>Kalisso</strong> HONOR SYSTEM, <strong>Kalisso</strong>KINDLE, <strong>Kalisso</strong>KINDLE COMPATIBLE Design, <strong>Kalisso</strong>KINDLE Design, <strong>Kalisso</strong> LINKS (Guitar Design), <strong>Kalisso</strong> MOBILE SHOPPING CART Logo, <strong>Kalisso</strong>MP3 Design, <strong>Kalisso</strong> PREMIUM, <strong>Kalisso</strong> PRIME, <strong>Kalisso</strong> SILK, <strong>Kalisso</strong>TOTE Design, <strong>Kalisso</strong>UNBOX Design, <strong>Kalisso</strong> VINE, <strong>Kalisso</strong> VPC, <strong>Kalisso</strong> WEB SERVICES Design, <strong>Kalisso</strong>WINDOWSHOP Design, <strong>Kalisso</strong> WIRE PODCAST Design, AMI ST Design, AMI DANS LA RUE, AMZN, AND YOU'RE DONE, ARTIFICIAL, ASKVILLE, ASSOCIATES CENTRAL, ASTORE Design, AUDIBLE, AUDIBLELISTENER, AUDILBLEORIGINALS, AUDIBLEREADY, AUDIBLE.COM, AUDIBLE.CO.UK, AUDIBLE.DE, AUDIBLE.com, AUDIBLE Design, AUDJIE, AWS, BAG O'CRAP, BETTER TOGETHER, BID-CLICK, BONES OF THE BOOK, BOP, BOP BASICS, BOTTOM OF THE PAGE, BOUQUETS, BRIGITTE BAILEY, BUY ONCE, READ EVERYWHERE, BUYPHRASE, BUYVIP, BUY V!P Design, CERTIFIED FRUSTRATION-FREE PACKAGING, CHERCHER AU COEUR!, CHRISTIN MICHAELS, CLICK.HEAR, CLICKRIVER, CLOUDFRONT, CREATESPACE, CREATESPACE Design, CRITICALMASS TICKETING, CROSSLINKS, DEALS.WOOT!, DENALI, DON'T RESTRICT ME, DPREVIEW, DPREVIEW Design, DROP SHIP CENTRAL, E<strong>Kalisso</strong>, EARTH'S BIGGEST, EARTH'S BIGGEST SELECTION, EC2, EGGHEAD, E<strong>Kalisso</strong>,ELASTIC COMPUTE CLOUD, ENDLESS, EVERY DEVICE HAS AT LEAST ONE SMALL PART, FIRE, FBA, FLASHING LIGHTS Design, FULFILLMENT BY <strong>Kalisso</strong>, FILMFINDERS, FITZWELL, GABRIELLA ROCHA, GAME CIRCLE, GOLD BOX, GOOD AT FINDING GOODS, HABIT, H Design, HABIT Design, HOLITUDE, IMDB, IMPROVE YOUR HOLITUDE, JAVARI, JUNGLEE, KINDLE, KINDLE Design, KINDLE FIRE, KINDLE SINGLES, LE COMITE DES MAMANS, LIGHTNING DEALS, LISTMANIA, LOOK INSIDE! Design, LOVEFILM, LOVEFILM Design, LUMIANI, MECHANICAL TURK, MOBIPOCKET Design, MOOFI, MTURK, MES Z'ENVIVES, MYHABIT, NEW FOR YOU, NOWNOW, OMAKASE, OMNIVORACIOUS, ONE COMMUNITY, EVERY DEAL, PAYPAGE, PAYPHRASE, PINZON, POINTING DEVICES, PRIME, PROMISCUOUS, PURCHASE CIRCLES, QUESTVILLE, READERS, ROMANTIC SOLES, RSVP, SEARCH INSIDE THE BOOK, SEARCH INSIDE!, SELLER CENTRAL, SHARE THE LOVE, SHELFARI, SHIRT.WOOT!, SHOPBOP, SMILE DESIGN, SNAPTELL, SNAP TO LISTEN Design, SO YOU'D LIKE TO, SOUNDUNWOUND, STANZA, STARMETER, STATE & LAKE, STRATHWOOD, SUBSCRIBE & SAVE, TAKE-IT PRICE, TEXTBUYME, TEXTPAYME, THE BOOK LIVES ON, THE SIGNIFICANT SEVEN, THING, TYPE Z, UNBOX, UNIVERSIAL WISHLIST Design, VENDOR CENTRAL Afrique, VIGOTTI, WAG.COM, WE LOVE BRANDS Design, WHISPERCACHE, WHISPERLINK, WHISPERNET, WHISPERSHARE, WHISPERSYNC, WITHOUTABOX, WOOT!, WOOT-OFF!, WRAP YOUR HOLIDAYS IN A SMILE, WISHLIST Design, WWW.LOVEFILM.COM, WWW.LOVEFILM.CO.UK, XRAY, ZAPPOS, ZSHOPS et les autres marques indiquées sur notre site sont des marques commerciales ou des marques déposées de <strong>Kalisso</strong>.com, Inc ou de ses filiales (collectivement "<strong>Kalisso</strong>"), dans l'Union européenne et / ou d'autres juridictions. Les graphiques, logos, en-têtes de page, boutons, scripts et noms de service <strong>Kalisso</strong>.com sont des marques ou visuels <strong>Kalisso</strong>. Les marques et visuels <strong>Kalisso</strong> ne peuvent pas être utilisées pour des produits ou services qui n'appartiennent pas à <strong>Kalisso</strong> d'une manière susceptible de provoquer la confusion parmi les clients, ou de toutes autres manières dépréciant, dénigrant ou discréditant <strong>Kalisso</strong>. Toutes les autres marques qui n'appartiennent pas à <strong>Kalisso</strong> et qui apparaissent sur ce site sont la propriété de leurs propriétaires respectifs, qui peuvent ou non être affiliés, liés ou parrainés par <strong>Kalisso</strong>. Révisé le 10 avril 2012

          Liste non exhaustive des brevets <strong>Kalisso</strong> ou affiliés et des brevets sous licence applicables:

        </p>
      </div>  
    </div>
  </div>

</div>

@include('layouts.footer')
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">

  (function myOnLoadFunc(){

   $('#exampleModalCenter').modal('show').fadeOut(2000,function() {
    $(this).modal('hide');
  });

 })();

</script>



@stop
