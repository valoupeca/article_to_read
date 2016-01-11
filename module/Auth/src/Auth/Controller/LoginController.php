<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Auth\Controller;

		use Zend\Session\Container;
		use Zend\View\Model\ViewModel;
		use MyLib\Controller\AppController;
		use Auth\Form\LoginForm;
		use Auth\Form\Filter\LoginFilter;
		use MyLib\Utility\UserPassword;

		class LoginController extends AppController {
			
			protected $storage;
			protected $authservice;
			
			public function indexAction(){       
				
				$request = $this->getRequest();
				
				$view = new ViewModel();
				$loginForm = new LoginForm('loginForm');       
				$loginForm->setInputFilter(new LoginFilter() );
				
				if($request->isPost()){
					$data = $request->getPost();
					$loginForm->setData($data);
					
					if($loginForm->isValid()){            	
						$data = $loginForm->getData();        

						$userPassword = new UserPassword();
						$encyptPass = $userPassword->create($data['password']);
						
						$this->getAuthService()
						->getAdapter()
						->setIdentity($data['email'])
						->setCredential($encyptPass);
						$result = $this->getAuthService()->authenticate();
						
						if ($result->isValid()) {
							
							$session = new Container('User');
							$session->offsetSet('email', $data['email']);
							
							$this->flashMessenger()->addMessage(array('success' => 'Login Success.'));
							// Redirect to page after successful login
						}else{
							$this->flashMessenger()->addMessage(array('error' => 'invalid credentials.'));
							// Redirect to page after login failure
						}
						return $this->redirect()->tourl('/auth/login');
						// Logic for login authentication                
					}else{
						$errors = $loginForm->getMessages();
						//prx($errors);  
					}
				}        
				
				$view->setVariable('loginForm', $loginForm);
				return $view;
			}
			
			private function getAuthService()
			{
				if (! $this->authservice) {
					$this->authservice = $this->getServiceLocator()->get('AuthService');
				}
				return $this->authservice;
			}

                        public function logoutAction(){
                          $session = new Container('User');
                          $session->getManager()->destroy();
                          $this->getAuthService()->clearIdentity();
                          return $this->redirect()->toUrl('/auth/login');
                        }
                }