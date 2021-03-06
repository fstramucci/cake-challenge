<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        // Es necesario permitir logout sin estar logeado
        $this->Auth->allow(['logout']);

        // Por defecto marca "users" como item activo del menu
        $this->active_menu_item = "users";
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return boolean
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // Index, view, edit y search son permitidas a usuarios logeados
        // Edit tiene restricciones especiales (definidas en la función)
        if (in_array($action, ['index', 'view', 'edit', 'search'])) {
            return true;
        }

        if (isset($user['role']) && $user['role'] === 'admin') {
            // es admin, permitir todas las acciones
            return true;
        }

        return false;
    }


    public function login()
    {
        $this->active_menu_item = "login";
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user && !$user['inactive']) {
                // el usuario existe y no fue desactivado
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Nombre de usuario o contraseña inválidos, o usuario desactivado.'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $searchString = $this->request->getQuery('query');
        if (!empty($searchString)) {
            // Hay una búsqueda activa
            $searchTermsArray = [];

            // Separamos por términos
            $terms = explode(' ', $searchString);
            foreach ($terms as $term) {
                // Cada uno de los términos puede referirse a id, username o email (combinador por OR)
                // Mientras que todos los términos en su conjunto tienen que estar presentes (combinados por AND)
                $searchTermsArray[] = ['OR' => [
                    ['id' => intval($term)],
                    ['username LIKE' => '%'.$term.'%'],
                    ['email LIKE' => '%'.$term.'%']
                ]] ;
            }
            $query = $this->Users->find('all')
            ->where([
                $searchTermsArray
            ]);
        } else {
            // Si no hay búsqueda activa, muestra todos
            $query = $this->Users;
        }
        // Y compagina
        $users = $this->paginate($query);

        $this->set(compact('users'));
        $this->set('query', $searchString);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario fue agregado correctamente.');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser agregado. Por favor, intente nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->isSelf($id) || $this->isAdmin()) {
            // se está editando a sí mismo, o es un admin

            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();

                if (empty($data['password'])) {
                    // password está vacío, no desea cambiarlo
                    unset($data['password']);
                }

                if ($this->isSelf($id)) {
                    // nadie puede editar su propio rol o desactivarse a sí mismo
                    unset($data['role']);
                    unset($data['inactive']);
                }

                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Los cambios fueron guardados correctamente.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No pudieron guardarse los cambios. Por favor, intente nuevamente'));
            }
            $this->set(compact('user'));
        } else {
            // no puede editar a otros usuarios sin ser admin
            $this->Flash->error('No puede editar a otros usuarios.');
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$this->isSelf($id)) {
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('El usuario fue borrado correctamente.'));
            } else {
                $this->Flash->error(__('El usuario no pudo ser borrado. Por favor, intente nuevamente.'));
            }
        } else {
            $this->Flash->error('No puede borrarse a sí mismo.');
        }

        return $this->redirect(['action' => 'index']);
    }

    private function isSelf($id)
    {
        $authUser = $this->Auth->user();

        if (intval($id) === $authUser['id']) {
            return true;
        }
        return false;
    }

    private function isAdmin()
    {
        $authUser = $this->Auth->user();

        if ($authUser && $authUser['role'] === 'admin') {
            return true;
        }
        return false;
    }
}
