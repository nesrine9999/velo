<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = [];
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_wdt']), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_search_results']), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler']), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_router']), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception']), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, ['_route' => '_profiler_exception_css']), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => '_twig_error_test']), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        // user_page_homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'UserBundle\\Controller\\DefaultController::indexAction',  '_route' => 'user_page_homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_user_page_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'user_page_homepage'));
            }

            return $ret;
        }
        not_user_page_homepage:

        if (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/register')) {
                // user_inscription
                if ('/register' === $pathinfo) {
                    return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::inscriptionAction',  '_route' => 'user_inscription',);
                }

                // fos_user_registration_register
                if ('/register' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'fos_user.registration.controller:registerAction',  '_route' => 'fos_user_registration_register',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not_fos_user_registration_register;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_registration_register'));
                    }

                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_registration_register;
                    }

                    return $ret;
                }
                not_fos_user_registration_register:

                // fos_user_registration_check_email
                if ('/register/check-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.registration.controller:checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_registration_check_email;
                    }

                    return $ret;
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                        $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'fos_user_registration_confirm']), array (  '_controller' => 'fos_user.registration.controller:confirmAction',));
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_fos_user_registration_confirm;
                        }

                        return $ret;
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ('/register/confirmed' === $pathinfo) {
                        $ret = array (  '_controller' => 'fos_user.registration.controller:confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                        if (!in_array($canonicalMethod, ['GET'])) {
                            $allow = array_merge($allow, ['GET']);
                            goto not_fos_user_registration_confirmed;
                        }

                        return $ret;
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            // rendezvous
            if (0 === strpos($pathinfo, '/rendezvous') && preg_match('#^/rendezvous/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'rendezvous']), array (  '_controller' => 'UserBundle\\Controller\\DefaultController::rendezvousAction',));
            }

            if (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ('/resetting/request' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:requestAction',  '_route' => 'fos_user_resetting_request',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_resetting_request;
                    }

                    return $ret;
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, ['_route' => 'fos_user_resetting_reset']), array (  '_controller' => 'fos_user.resetting.controller:resetAction',));
                    if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                        $allow = array_merge($allow, ['GET', 'POST']);
                        goto not_fos_user_resetting_reset;
                    }

                    return $ret;
                }
                not_fos_user_resetting_reset:

                // fos_user_resetting_send_email
                if ('/resetting/send-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                    if (!in_array($requestMethod, ['POST'])) {
                        $allow = array_merge($allow, ['POST']);
                        goto not_fos_user_resetting_send_email;
                    }

                    return $ret;
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ('/resetting/check-email' === $pathinfo) {
                    $ret = array (  '_controller' => 'fos_user.resetting.controller:checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                    if (!in_array($canonicalMethod, ['GET'])) {
                        $allow = array_merge($allow, ['GET']);
                        goto not_fos_user_resetting_check_email;
                    }

                    return $ret;
                }
                not_fos_user_resetting_check_email:

            }

        }

        elseif (0 === strpos($pathinfo, '/Espace')) {
            // EspaceAcheteur
            if ('/EspaceAcheteur' === $pathinfo) {
                return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::EspaceAcheteurAction',  '_route' => 'EspaceAcheteur',);
            }

            // EspaceReparateur
            if ('/EspaceReparateur' === $pathinfo) {
                return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::EspaceReparateurAction',  '_route' => 'EspaceReparateur',);
            }

            // EspaceRdv
            if (0 === strpos($pathinfo, '/EspaceRdv') && preg_match('#^/EspaceRdv/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'EspaceRdv']), array (  '_controller' => 'UserBundle\\Controller\\DefaultController::EspaceRdvAction',));
            }

        }

        // boot
        if ('/boot' === $pathinfo) {
            return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::bootAction',  '_route' => 'boot',);
        }

        // index
        if ('/index' === $pathinfo) {
            return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::indexAction',  '_route' => 'index',);
        }

        // ajax_search
        if ('/search' === $pathinfo) {
            return array (  '_controller' => 'UserBundle\\Controller\\DefaultController::searchAction',  '_route' => 'ajax_search',);
        }

        // ecommerce_homepage
        if ('/acheteur' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'EcommerceBundle\\Controller\\DefaultController::indexAction',  '_route' => 'ecommerce_homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_ecommerce_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'ecommerce_homepage'));
            }

            return $ret;
        }
        not_ecommerce_homepage:

        if (0 === strpos($pathinfo, '/admin')) {
            // admin_homepage
            if ('/admin' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::indexAction',  '_route' => 'admin_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_admin_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'admin_homepage'));
                }

                return $ret;
            }
            not_admin_homepage:

            if (0 === strpos($pathinfo, '/admin/Affiche')) {
                // admin_AfficherUser
                if ('/admin/AfficherUser' === $pathinfo) {
                    return array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::AfficherUserAction',  '_route' => 'admin_AfficherUser',);
                }

                // Affiche
                if ('/admin/Affiche' === $pathinfo) {
                    return array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::AfficheAction',  '_route' => 'Affiche',);
                }

            }

            // Ajouter
            if ('/admin/Ajouter' === $pathinfo) {
                return array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::AjouterAction',  '_route' => 'Ajouter',);
            }

            // actualitemodifier
            if (0 === strpos($pathinfo, '/admin/actualitemodifier') && preg_match('#^/admin/actualitemodifier/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'actualitemodifier']), array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::modifieractualiteAction',));
            }

            // Supprimer
            if (0 === strpos($pathinfo, '/admin/Supprimer') && preg_match('#^/admin/Supprimer/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'Supprimer']), array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::SupprimerAction',));
            }

            // Reparateurs
            if ('/admin/Reparateurs' === $pathinfo) {
                return array (  '_controller' => 'AdminBundle\\Controller\\DashboardController::ReparateursAction',  '_route' => 'Reparateurs',);
            }

        }

        elseif (0 === strpos($pathinfo, '/chef-equipe')) {
            // evenement_homepage
            if ('/chef-equipe' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'EvenementBundle\\Controller\\DefaultController::indexAction',  '_route' => 'evenement_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_evenement_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'evenement_homepage'));
                }

                return $ret;
            }
            not_evenement_homepage:

            // ajouter_event
            if ('/chef-equipe/ajouter_event' === $pathinfo) {
                return array (  '_controller' => 'EvenementBundle\\Controller\\EvenementController::AjouterEventAction',  '_route' => 'ajouter_event',);
            }

            // afficher_event
            if ('/chef-equipe/afficher_event' === $pathinfo) {
                return array (  '_controller' => 'EvenementBundle\\Controller\\EvenementController::AfficherEventAction',  '_route' => 'afficher_event',);
            }

            // supprimer_event
            if (0 === strpos($pathinfo, '/chef-equipe/supprimer_event') && preg_match('#^/chef\\-equipe/supprimer_event/(?P<cin>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'supprimer_event']), array (  '_controller' => 'EvenementBundle\\Controller\\EvenementController::SupprimerEventAction',));
            }

            // modifier_event
            if (0 === strpos($pathinfo, '/chef-equipe/modifier_event') && preg_match('#^/chef\\-equipe/modifier_event/(?P<cin>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, ['_route' => 'modifier_event']), array (  '_controller' => 'EvenementBundle\\Controller\\EvenementController::ModifierEventAction',));
            }

        }

        elseif (0 === strpos($pathinfo, '/vendeur')) {
            // ecom_homepage
            if ('/vendeur/actualite' === $pathinfo) {
                return array (  '_controller' => 'EcomBundle\\Controller\\DefaultController::actualiteAction',  '_route' => 'ecom_homepage',);
            }

            // ecom_location
            if ('/vendeur/location' === $pathinfo) {
                return array (  '_controller' => 'EcomBundle\\Controller\\DefaultController::locationAction',  '_route' => 'ecom_location',);
            }

            if (0 === strpos($pathinfo, '/vendeur/formulaire')) {
                // ecom_formulaire
                if ('/vendeur/formulaire' === $pathinfo) {
                    return array (  '_controller' => 'EcomBundle\\Controller\\DefaultController::formulaireAction',  '_route' => 'ecom_formulaire',);
                }

                // ecom_formulaire_vente
                if ('/vendeur/formulaire_vente' === $pathinfo) {
                    return array (  '_controller' => 'EcomBundle\\Controller\\VenteController::formulaireAction',  '_route' => 'ecom_formulaire_vente',);
                }

            }

            // ecom_vente
            if ('/vendeur/ecom_vente' === $pathinfo) {
                return array (  '_controller' => 'EcomBundle\\Controller\\VenteController::locationAction',  '_route' => 'ecom_vente',);
            }

        }

        elseif (0 === strpos($pathinfo, '/login')) {
            // fos_user_security_login
            if ('/login' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.security.controller:loginAction',  '_route' => 'fos_user_security_login',);
                if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                    $allow = array_merge($allow, ['GET', 'POST']);
                    goto not_fos_user_security_login;
                }

                return $ret;
            }
            not_fos_user_security_login:

            // fos_user_security_check
            if ('/login_check' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.security.controller:checkAction',  '_route' => 'fos_user_security_check',);
                if (!in_array($requestMethod, ['POST'])) {
                    $allow = array_merge($allow, ['POST']);
                    goto not_fos_user_security_check;
                }

                return $ret;
            }
            not_fos_user_security_check:

        }

        // fos_user_security_logout
        if ('/logout' === $pathinfo) {
            $ret = array (  '_controller' => 'fos_user.security.controller:logoutAction',  '_route' => 'fos_user_security_logout',);
            if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                $allow = array_merge($allow, ['GET', 'POST']);
                goto not_fos_user_security_logout;
            }

            return $ret;
        }
        not_fos_user_security_logout:

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if ('/profile' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'fos_user.profile.controller:showAction',  '_route' => 'fos_user_profile_show',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_fos_user_profile_show;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_profile_show'));
                }

                if (!in_array($canonicalMethod, ['GET'])) {
                    $allow = array_merge($allow, ['GET']);
                    goto not_fos_user_profile_show;
                }

                return $ret;
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ('/profile/edit' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.profile.controller:editAction',  '_route' => 'fos_user_profile_edit',);
                if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                    $allow = array_merge($allow, ['GET', 'POST']);
                    goto not_fos_user_profile_edit;
                }

                return $ret;
            }
            not_fos_user_profile_edit:

            // fos_user_change_password
            if ('/profile/change-password' === $pathinfo) {
                $ret = array (  '_controller' => 'fos_user.change_password.controller:changePasswordAction',  '_route' => 'fos_user_change_password',);
                if (!in_array($canonicalMethod, ['GET', 'POST'])) {
                    $allow = array_merge($allow, ['GET', 'POST']);
                    goto not_fos_user_change_password;
                }

                return $ret;
            }
            not_fos_user_change_password:

        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
