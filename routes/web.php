<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AuthenticateAdmin;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentDashboard;
use App\Http\Controllers\Agent\AuthenticateAgent;
use App\Http\Controllers\Agent\Extrait\AgentHistoriqueController;
use App\Http\Controllers\Agent\Extrait\Deces\AgentDecesController;
use App\Http\Controllers\Agent\Extrait\Mariage\AgentMariageController;
use App\Http\Controllers\Agent\Extrait\Naissance\AgentNaissanceController;
use App\Http\Controllers\Agent\Extrait\RecuperationController;
use App\Http\Controllers\Comptable\AuthenticateComptable;
use App\Http\Controllers\Comptable\ComptableController;
use App\Http\Controllers\Comptable\ComptableDashboard;
use App\Http\Controllers\Comptable\Timbre\TimbreController;
use App\Http\Controllers\Delivery\AuthenticateDelivery;
use App\Http\Controllers\Delivery\DeliveryController;
use App\Http\Controllers\Delivery\DeliveryDashboard;
use App\Http\Controllers\Delivery\DeliveryVersement;
use App\Http\Controllers\Delivery\LivraisonDelivery;
use App\Http\Controllers\Dhl\Agence\AgenceDelivery;
use App\Http\Controllers\Dhl\Agence\AgencyDashboard;
use App\Http\Controllers\Dhl\Agence\AuthenticateDhlAgence;
use App\Http\Controllers\Dhl\Agence\DhlAgenceController;
use App\Http\Controllers\Dhl\AuthenticateDhl;
use App\Http\Controllers\Dhl\Dhlcontroller;
use App\Http\Controllers\Dhl\DhlDashboard;
use App\Http\Controllers\Dhl\DhlLivraisonExtraitController;
use App\Http\Controllers\EtatCivil\AuthenticateEtatCivil;
use App\Http\Controllers\EtatCivil\EtatCivilController;
use App\Http\Controllers\EtatCivil\EtatCivilDashboard;
use App\Http\Controllers\EtatCivil\Extrait\EtatDecesController;
use App\Http\Controllers\EtatCivil\Extrait\EtatHistoriquesController;
use App\Http\Controllers\EtatCivil\Extrait\EtatMariageController;
use App\Http\Controllers\EtatCivil\Extrait\EtatNaissanceController;
use App\Http\Controllers\Finance\AuthenticateFinance;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Finance\FinanceDashboard;
use App\Http\Controllers\Finance\Timbre\FinanceTimbreController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Mairie\Extrait\MairieDecesController;
use App\Http\Controllers\Mairie\Extrait\MairieMariageController;
use App\Http\Controllers\Mairie\Extrait\MairieNaissanceController;
use App\Http\Controllers\Mairie\MairieAuthenticate;
use App\Http\Controllers\Mairie\MairieController;
use App\Http\Controllers\Mairie\MairieDashboard;
use App\Http\Controllers\Poste\AuthenticatePoste;
use App\Http\Controllers\Poste\LivraisonExtraitController;
use App\Http\Controllers\Poste\PosteController;
use App\Http\Controllers\Poste\PosteDashboard;
use App\Http\Controllers\User\AuthenticateUser;
use App\Http\Controllers\User\Extrait\DecesController;
use App\Http\Controllers\User\Extrait\MariageController;
use App\Http\Controllers\User\Extrait\NaissanceController;
use App\Http\Controllers\User\UserDashbaord;
use App\Models\Dhl;
use App\Models\Poste;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function(){
    Route::get('/',[HomeController::class,'home'])->name('home');
});

//Les routes de gestion du @super admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthenticateAdmin::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthenticateAdmin::class, 'handleLogin'])->name('admin.handleLogin');
});

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminDashboard::class, 'logout'])->name('admin.logout');


    //Les routes de gestion de la mairie par l'admin
    Route::prefix('mairie')->group(function(){
        Route::get('/index', [MairieController::class, 'index'])->name('admin.index');
        Route::get('/index/archive', [MairieController::class, 'archive'])->name('admin.archive');
        Route::get('/create', [MairieController::class, 'create'])->name('admin.create');
        Route::post('/store', [MairieController::class, 'store'])->name('admin.store');
        Route::post('/add-solde', [MairieController::class, 'addSolde'])->name('admin.add_solde');

        Route::delete('/{vendor}/archive', [MairieController::class, 'archive'])->name('mairie.archive');
        Route::put('/mairie/unarchive/{id}', [MairieController::class, 'unarchive'])->name('mairie.unarchive');
        Route::delete('/{vendor}/delete', [MairieController::class, 'vendordelete'])->name('mairie.delete');
    });

    //les routes de gestion de la poste par l'admin
    Route::prefix('post')->group(function(){
        Route::get('/indexpost', [PosteController::class, 'index'])->name('post.index');
        Route::get('/createpost', [PosteController::class, 'create'])->name('post.create');
        Route::post('/create', [PosteController::class, 'store'])->name('post.store');
        Route::get('/{post}/edit', [PosteController::class, 'edit'])->name('post.edit');
    });

     Route::prefix('dhl')->group(function(){
        Route::get('/indexdhl', [Dhlcontroller::class, 'index'])->name('dhl.index');
        Route::get('/createdhl', [Dhlcontroller::class, 'create'])->name('dhl.create');
        Route::post('/createdhl', [Dhlcontroller::class, 'store'])->name('dhl.store');
        Route::get('/{dhl}/edit', [Dhlcontroller::class, 'edit'])->name('dhl.edit');
    });
});

//Les routes de gestion de la @mairie
Route::prefix('mairie')->group(function(){
    Route::get('/login',[MairieAuthenticate::class,'login'])->name('mairie.login');
    Route::post('/login',[MairieAuthenticate::class,'handleLogin'])->name('mairie.handleLogin');
});

Route::middleware('mairie')->prefix('mairie')->group(function(){
     Route::get('/dashboard',[MairieDashboard::class,'dashboard'])->name('mairie.dashboard');
     Route::get('/logout', [MairieDashboard::class, 'logout'])->name('mairie.logout');

     //Les routes pour la liste des demandes 
     Route::prefix('request')->group(function(){
        Route::get('/birth',[MairieNaissanceController::class,'birthRequest'])->name('mairie.request.birth');
        Route::get('/death',[MairieDecesController::class,'deathRequest'])->name('mairie.request.death');
        Route::get('/wedding',[MairieMariageController::class,'weddingRequest'])->name('mairie.request.wedding');
     });

     //Les routes de gestion d'etat civil par la mairie 
     Route::prefix('state')->group(function(){
        Route::get('/indexd',[EtatCivilController::class,'index'])->name('mairie.state.index');
        Route::get('/create',[EtatCivilController::class,'create'])->name('mairie.state.create');
        Route::post('/create',[EtatCivilController::class,'store'])->name('mairie.state.store');
        Route::delete('/etat-civil/{id}', [EtatCivilController::class, 'destroy'])->name('etat-civil.destroy');
        Route::get('/etat-civil/{id}/edit', [EtatCivilController::class, 'edit'])->name('etat-civil.edit');
        Route::put('/etat-civil/{id}', [EtatCivilController::class, 'update'])->name('etat-civil.update');
     });

     Route::prefix('finance')->group(function(){
        Route::get('/index/money',[FinanceController::class,'index'])->name('mairie.finance.index');
        Route::get('/create/price',[FinanceController::class,'create'])->name('mairie.finance.create');
        Route::post('/create',[FinanceController::class,'store'])->name('mairie.finance.store');
        Route::delete('/{id}', [FinanceController::class, 'destroy'])->name('finance.destroy');
        Route::get('/{id}/edit', [FinanceController::class, 'edit'])->name('finance.edit');
        Route::put('/{id}', [FinanceController::class, 'update'])->name('finance.update');
     });
});

//Les routes de gestion de la @etat_civil
Route::prefix('state')->group(function(){
    Route::get('/login',[AuthenticateEtatCivil::class,'login'])->name('etat_civil.login');
    Route::post('/login',[AuthenticateEtatCivil::class,'handleLogin'])->name('etat_civil.handleLogin');
});

Route::middleware('etatCivil')->prefix('state')->group(function(){
     Route::get('/dashboard',[EtatCivilDashboard::class,'dashboard'])->name('etat_civil.dashboard');
     Route::get('/logout', [EtatCivilDashboard::class, 'logout'])->name('etat_civil.logout');

     //Les routes pour la liste des demandes 
     Route::prefix('request')->group(function(){
        Route::get('/birth',[EtatNaissanceController::class,'birthRequest'])->name('etat_civil.request.birth');
        Route::get('/death',[EtatDecesController::class,'deathRequest'])->name('etat_civil.request.death');
        Route::get('/wedding',[EtatMariageController::class,'weddingRequest'])->name('etat_civil.request.wedding');
     });

     //les routes d'ajoutes des @agent_etat_civil
     Route::prefix('agent/state')->group(function(){
        Route::get('/index',[AgentController::class,'index'])->name('etat_civil.agent.state.index');
        Route::get('/create',[AgentController::class,'create'])->name('etat_civil.agent.state.create');
        Route::post('/create',[AgentController::class,'store'])->name('etat_civil.agent.state.store');
     });

     //Historiques des traitements de tous les agents 
    Route::get('/task/end/history',[EtatHistoriquesController::class, 'history'])->name('etat_civil.history.taskend');
    Route::get('/task/end/livree',[EtatHistoriquesController::class, 'livree'])->name('etat_civil.livree.taskend');
});

//Les routes de gestion des @agents
Route::prefix('agent')->group(function() {
    Route::get('/login', [AuthenticateAgent::class, 'login'])->name('agent.login');
    Route::post('/login', [AuthenticateAgent::class, 'handleLogin'])->name('agent.handleLogin');
});

Route::middleware('agent')->prefix('agent')->group(function(){
    Route::get('/dashboard', [AgentDashboard::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/logout', [AgentDashboard::class, 'logout'])->name('agent.logout');

    //les routes pour la recuperation des demandes 
    Route::post('/naissance/recover/{id}', [RecuperationController::class, 'RecupererNaissance'])->name('naissance.traiter');
    Route::post('/deces/recover/{id}', [RecuperationController::class, 'RecupererDeces'])->name('deces.traiter');
    Route::post('/mariage/recover/{id}', [RecuperationController::class, 'RecupererMariage'])->name('mariage.traiter');

    //Les routes des demandes recuperer de naissance
    Route::get('/all/requests/birth', [AgentNaissanceController::class, 'index'])->name('agent.demandes.naissance.index');
    Route::get('/naissance/{id}/edit', [AgentNaissanceController::class, 'edit'])->name('agent.demandes.naissance.edit');
    Route::post('/naissance/{id}/update-etat', [AgentNaissanceController::class, 'updateEtat'])->name('agent.demandes.naissance.update');
    Route::post('/livraison/{id}', [AgentNaissanceController::class, 'markAsDelivered'])->name('livraison.mark');
    Route::get('/telecharger-info-livraison/{id}', [AgentNaissanceController::class, 'downloadDeliveryInfo'])->name('agent.download.delivery.info');

    //Les routes des demandes recuperer de deces 
    Route::get('/all/requests/death', [AgentDecesController::class, 'index'])->name('agent.demandes.deces.index');
    Route::get('/deces/{id}/edit', [AgentDecesController::class, 'edit'])->name('agent.demandes.deces.edit'); 
    Route::post('/deces/{id}/update-etat', [AgentDecesController::class, 'updateEtat'])->name('agent.demandes.deces.update');
    Route::post('/deces/livraison/{id}', [AgentDecesController::class, 'markAsDeliveredDeces'])->name('livraison.mark.deces');
    Route::get('/deces/telecharger-info-livraison/{id}', [AgentDecesController::class, 'downloadDeliveryInfo'])->name('agent.download.deces.delivery.info');

    //Les routes des demandes recuperer mariages
    Route::get('/all/requests/wedding', [AgentMariageController::class, 'index'])->name('agent.demandes.wedding.index');
    Route::get('/mariage/{id}/edit', [AgentMariageController::class, 'edit'])->name('agent.demandes.wedding.edit');
    Route::post('/mariage/{id}/update-etat', [AgentMariageController::class, 'updateEtat'])->name('agent.demandes.wedding.update');
    Route::post('/mariage/livraison/{id}', [AgentMariageController::class, 'markAsDeliveredMariage'])->name('livraison.mark.mariage');
    Route::get('/mariage/telecharger-info-livraison/{id}', [AgentMariageController::class, 'downloadDeliveryInfo'])->name('agent.download.mariage.delivery.info');


    //Historiques des traitements effectuer par l'agent 
    Route::get('/task/end/history',[AgentHistoriqueController::class, 'history'])->name('agent.history.taskend');
    Route::get('/task/end/livree',[AgentHistoriqueController::class, 'livree'])->name('agent.livree.taskend');
});

//Les routes de gestion de la @finance
Route::prefix('finance')->group(function(){
    Route::get('/login',[AuthenticateFinance::class,'login'])->name('finance.login');
    Route::post('/login',[AuthenticateFinance::class,'handleLogin'])->name('finance.handleLogin');
});

Route::middleware('finance')->prefix('finance')->group(function(){
    Route::get('/dashboard', [FinanceDashboard::class, 'dashboard'])->name('finance.dashboard');
    Route::get('/logout', [FinanceDashboard::class, 'logout'])->name('finance.logout');

     //les routes des financiers de la caisse
    Route::prefix('accounting')->group(function () {
        Route::get('/index',[ComptableController::class, 'index'])->name('comptable.index');
        Route::get('/create',[ComptableController::class, 'create'])->name('comptable.create');
        Route::post('/create',[ComptableController::class, 'store'])->name('comptable.store');
        Route::get('/edit/{comptable}',[ComptableController::class, 'edit'])->name('comptable.edit');
        Route::put('/edit/{comptable}',[ComptableController::class, 'update'])->name('comptable.update');
        Route::delete('/delete/{comptable}',[ComptableController::class, 'delete'])->name('comptable.delete');
        Route::get('/accounting/export-pdf/{id}', [ComptableController::class, 'exportPdf'])->name('comptable.comptable.export-pdf');
    });

     //Les routes de timbres 
    Route::prefix('stamp')->group(function(){
        Route::get('/refill', [FinanceTimbreController::class, 'recharge'])->name('finance.timbre.recharge');
        Route::post('/refill', [FinanceTimbreController::class, 'store'])->name('finance.timbre.store');
        Route::get('/sell', [FinanceTimbreController::class, 'vente'])->name('finance.timbre.vente');
        Route::get('/history', [FinanceTimbreController::class, 'history'])->name('finance.timbre.history');
        Route::get('/statistiques', [FinanceTimbreController::class, 'statistiques'])->name('finance.timbre.statistiques');
        Route::get('/finance/statistiques/pdf', [FinanceTimbreController::class, 'generatePDF'])->name('finance.stats.pdf');
    });
});

//Les routes de gestion de la @comptable
Route::prefix('accounting')->group(function(){
    Route::get('/login',[AuthenticateComptable::class,'login'])->name('comptable.login');
    Route::post('/login',[AuthenticateComptable::class,'handleLogin'])->name('comptable.handleLogin');
});

Route::middleware('comptable')->prefix('accounting')->group(function(){
    Route::get('/dashboard', [ComptableDashboard::class, 'dashboard'])->name('comptable.dashboard');
    Route::get('/logout', [ComptableDashboard::class, 'logout'])->name('comptable.logout');

    //les routes des timbres 
    Route::prefix('stamp')->group(function(){
         Route::get('/create', [TimbreController::class, 'create'])->name('timbre.create');
         Route::post('/sell', [TimbreController::class, 'store'])->name('comptable.timbre.storeVente');
         Route::get('/history', [TimbreController::class, 'history'])->name('comptable.timbre.history');
         Route::get('/statistiques', [TimbreController::class, 'statistiques'])->name('comptable.timbre.statistiques');
         Route::get('/tendance-ventes', [TimbreController::class, 'tendanceVentes'])->name('comptable.timbre.tendanceVentes');
    });
});

//Les routes de getsion de @postes 
    Route::prefix('post')->group(function() {
        Route::get('/login', [AuthenticatePoste::class, 'login'])->name('post.login');
        Route::post('/login', [AuthenticatePoste::class, 'handleLogin'])->name('post.handleLogin');
    });

    Route::middleware('poste')->prefix('post')->group(function(){
        Route::get('/dahboard', [PosteDashboard::class, 'dashboard'])->name('post.dashboard');
        Route::get('/logout', [PosteDashboard::class, 'logout'])->name('post.logout');

        //Gestion des livreurs par la poste 
            Route::prefix('delivery')->group(function(){
                Route::get('/index',[DeliveryController::class, 'index'])->name('delivery.index');
                Route::get('/create',[DeliveryController::class, 'create'])->name('delivery.create');
                Route::post('/create',[DeliveryController::class, 'store'])->name('delivery.store');
                Route::get('/edit/{delivery}',[DeliveryController::class, 'edit'])->name('delivery.edit');
                Route::put('/edit/{delivery}',[DeliveryController::class, 'update'])->name('delivery.update');
                Route::delete('/delete/{delivery}',[DeliveryController::class, 'delete'])->name('delivery.delete');

                Route::get('/livreur/{livreur}/versement', [DeliveryVersement::class, 'versement'])->name('poste.livreur.versement');
                Route::post('/livreur/{livreur}/versement', [DeliveryVersement::class, 'processVersement'])->name('poste.livreur.versement.process');
            });

            //La route des demandes à livrer
            Route::prefix('livraison')->group(function () {
                Route::get('/createed', [LivraisonExtraitController::class, 'create'])->name('livraison.create');
                Route::post('/posted/attribuer-demande', [LivraisonExtraitController::class, 'attribuerDemande'])->name('poste.attribuer-demande');
                Route::get('/poste/demandes-attribuees', [LivraisonExtraitController::class, 'demandesAttribuees'])->name('poste.demandes-attribuees');
                Route::get('/poste/demandes-livree', [LivraisonExtraitController::class, 'demandesLivree'])->name('poste.demandes-livree');
                Route::post('/poste/assigner-livreur', [LivraisonExtraitController::class, 'assignerLivreur'])->name('poste.assigner-livreur');
            });

            Route::get('/poste/mairies/colis', [PosteDashboard::class, 'getColisParMairie'])->name('poste.mairies.colis');
    });

//Les routes de getsion de @livreur 
        Route::prefix('delivery')->group(function() {
            Route::get('/login', [AuthenticateDelivery::class, 'login'])->name('delivery.login');
            Route::post('/login', [AuthenticateDelivery::class, 'handleLogin'])->name('delivery.handleLogin');
        });

        Route::middleware('livreur')->prefix('delivery')->group(function(){
            Route::get('/dahboard', [DeliveryDashboard::class, 'dashboard'])->name('delivery.dashboard');
            Route::get('/logout', [DeliveryDashboard::class, 'logout'])->name('delivery.logout');
            Route::post('/livreur/toggle-disponibilite', [DeliveryDashboard::class, 'toggleDisponibilite'])->name('livreur.toggleDisponibilite');

            //Gestion des livraison par le livreur
            Route::get('/livraison',[LivraisonDelivery::class,'delivery'])->name('livreur.livraison');
            Route::get('/delivery/livree',[LivraisonDelivery::class,'livree'])->name('livreur.livree');

            Route::get('/livraison/validate', [LivraisonDelivery::class, 'validated'])->name('livreur.validated');
            Route::post('/livraison/validate', [LivraisonDelivery::class, 'validated']);
            Route::post('/check-reference', [LivraisonDelivery::class, 'checkReference'])->name('livreur.check-reference');
            
        });

           //Les routes de getsion de @dhl 
        Route::prefix('dhl')->group(function() {
            Route::get('/login', [AuthenticateDhl::class, 'login'])->name('dhl.login');
            Route::post('/login', [AuthenticateDhl::class, 'handleLogin'])->name('dhl.handleLogin');
        });

        Route::middleware('dhl')->prefix('dhl')->group(function(){
            Route::get('/dahboard', [DhlDashboard::class, 'dashboard'])->name('dhl.dashboard');
            Route::get('/logout', [DhlDashboard::class, 'logout'])->name('dhl.logout');

            Route::prefix('agency')->group(function(){
                Route::get('/index',[DhlAgenceController::class, 'index'])->name('agency.index');
                Route::get('/create',[DhlAgenceController::class, 'create'])->name('agency.create');
                Route::post('/create',[DhlAgenceController::class, 'store'])->name('agency.store');
                Route::get('/edit/{agency}',[DhlAgenceController::class, 'edit'])->name('agency.edit');
                Route::put('/edit/{agency}',[DhlAgenceController::class, 'update'])->name('agency.update');
                Route::delete('/delete/{agency}',[DhlAgenceController::class, 'delete'])->name('agency.delete');
            });

            //La route des demandes à livrer
            Route::prefix('livraison')->group(function () {
                Route::get('/createed', [DhlLivraisonExtraitController::class, 'create'])->name('dhl.livraison.create');
                Route::post('/posted/attribuer-demande', [DhlLivraisonExtraitController::class, 'attribuerDemande'])->name('dhl.attribuer-demande');
                Route::get('/dhl/demandes-attribuees', [DhlLivraisonExtraitController::class, 'demandesAttribuees'])->name('dhl.demandes-attribuees');
                Route::get('/dhl/demandes-livree', [DhlLivraisonExtraitController::class, 'demandesLivree'])->name('dhl.demandes-livree');
                Route::post('/dhl/assigner-livreur', [DhlLivraisonExtraitController::class, 'assignerLivreur'])->name('dhl.assigner-livreur');
            });

            Route::get('/dhl/mairies/colis', [DhlDashboard::class, 'getColisParMairie'])->name('dhl.mairies.colis');

        });

        //Les routes de getsion de @agence 
         Route::prefix('agency')->group(function() {
            Route::get('/login', [AuthenticateDhlAgence::class, 'login'])->name('agency.login');
            Route::post('/login', [AuthenticateDhlAgence::class, 'handleLogin'])->name('agency.handleLogin');
        });

        Route::middleware('agency')->prefix('agency')->group(function(){
            Route::get('/dahboard', [AgencyDashboard::class, 'dashboard'])->name('agency.dashboard');
            Route::get('/logout', [AgencyDashboard::class, 'logout'])->name('agency.logout');
            Route::post('/agency/toggle-disponibilite', [AgencyDashboard::class, 'toggleDisponibilite'])->name('agency.toggleDisponibilite');

            //Gestion des livraison par le agence
            Route::get('/livraison',[AgenceDelivery::class,'delivery'])->name('agency.livraison');
            Route::get('/delivery/livree',[AgenceDelivery::class,'livree'])->name('agency.livree');

            Route::get('/livraison/validate', [AgenceDelivery::class, 'validated'])->name('agency.validated');
            Route::post('/livraison/validate', [AgenceDelivery::class, 'validated']);
            Route::post('/check-reference', [AgenceDelivery::class, 'checkReference'])->name('agency.check-reference');
        });

//Les routes de gestion de @user
Route::prefix('user')->group(function(){
    Route::get('/login',[AuthenticateUser::class,'login'])->name('login');
    Route::post('/login',[AuthenticateUser::class,'handleLogin'])->name('handleLogin');
    Route::get('/register',[AuthenticateUser::class,'register'])->name('register');
    Route::post('/register',[AuthenticateUser::class,'handleRegister'])->name('handleRegister');
});

Route::middleware('auth')->prefix('user')->group(function(){
     Route::get('/dashboard',[UserDashbaord::class,'dashboard'])->name('user.dashboard');
     Route::get('/logout', [UserDashbaord::class, 'logout'])->name('user.logout');

     //Les de demandes d'extraits par l'utilisateur
     //Les demandes d'extrait de naissance 
     Route::prefix('birth')->group(function(){
        Route::get('/extract/index', [NaissanceController::class, 'index'])->name('user.extrait.birth.index'); 
        Route::get('/extract/create',[NaissanceController::class,'create'])->name('user.birth.create');
        Route::post('/extract/create', [NaissanceController::class, 'store'])->name('user.extrait.birth.store');
     });

     //Les demandes d'extrait de deces 
     Route::prefix('death')->group(function(){
        Route::get('/extract/index', [DecesController::class, 'index'])->name('user.extrait.death.index'); 
        Route::get('/extract/create',[DecesController::class,'create'])->name('user.death.create');
        Route::post('/extract/create', [DecesController::class, 'store'])->name('user.extrait.death.store');
     });

     //Les routes d'extrait de mariage
    Route::prefix('wedding')->group(function(){
        Route::get('/index', [MariageController::class, 'index'])->name('user.extrait.mariage.index');
        Route::get('/create', [MariageController::class, 'create'])->name('user.mariage.create');
        Route::post('/create', [MariageController::class, 'store'])->name('user.extrait.mariage.store');
        Route::get('/delete/{mariage}', [MariageController::class, 'delete'])->name('user.extrait.mariage.delete');
    });
});

//Les routes definition du accès 
Route::get('/validate-mairie-account/{email}', [MairieAuthenticate::class, 'defineAccess']);
Route::post('/validate-mairie-account/{email}', [MairieAuthenticate::class, 'submitDefineAccess'])->name('mairie.validate');
Route::get('/validate-state-account/{email}', [AuthenticateEtatCivil::class, 'defineAccess']);
Route::post('/validate-state-account/{email}', [AuthenticateEtatCivil::class, 'submitDefineAccess'])->name('etat_civil.validate');
Route::get('/validate-finance-account/{email}', [AuthenticateFinance::class, 'defineAccess']);
Route::post('/validate-finance-account/{email}', [AuthenticateFinance::class, 'submitDefineAccess'])->name('finance.validate');
Route::get('/validate-agent-account/{email}', [AuthenticateAgent::class, 'defineAccess']);
Route::post('/validate-agent-account/{email}', [AuthenticateAgent::class, 'submitDefineAccess'])->name('agent.validate');
Route::get('/validate-accounting-account/{email}', [AuthenticateComptable::class, 'defineAccess']);
Route::post('/validate-accounting-account/{email}', [AuthenticateComptable::class, 'submitDefineAccess'])->name('comptable.validate');
Route::get('/validate-post-account/{email}', [AuthenticatePoste::class, 'defineAccess']);
Route::post('/validate-post-account/{email}', [AuthenticatePoste::class, 'submitDefineAccess'])->name('post.validate');
Route::get('/validate-delivery-account/{email}', [AuthenticateDelivery::class, 'defineAccess']);
Route::post('/validate-delivery-account/{email}', [AuthenticateDelivery::class, 'submitDefineAccess'])->name('delivery.validate');
Route::get('/validate-dhl-account/{email}', [AuthenticateDhl::class, 'defineAccess']);
Route::post('/validate-dhl-account/{email}', [AuthenticateDhl::class, 'submitDefineAccess'])->name('dhl.validate');
Route::get('/validate-agency-account/{email}', [AuthenticateDhlAgence::class, 'defineAccess']);
Route::post('/validate-agency-account/{email}', [AuthenticateDhlAgence::class, 'submitDefineAccess'])->name('agency.validate');

// Route pour récupérer la liste des postes
    Route::get('/postes/list', function() {
        $postes = Poste::all(); 
        return response()->json($postes);
    })->name('postes.list');

    // Route pour récupérer la liste des DHLs
    Route::get('/dhls/list', function() {
        $dhls = Dhl::all();
        return response()->json($dhls);
    })->name('dhls.list');

