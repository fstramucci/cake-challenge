<h2>Cake Challenge</h2>
<h5>Por Franco Stramucci - <a href="mailto:stramucci@gmail.com">stramucci@gmail.com</a></h5>

<p>Esta es una prueba técnica para la empresa de e-learning chilena <a href="https://www.eclass.com/" target="_blank">eClass</a>.</p>
<p>
  Hay dos tipos de usuario: "admin" y "guest". Los usuarios con el rol "admin" pueden realizar
  todas las acciones, excepto desactivarse, borrarse o cambiar su rol.
  Los usuarios "guest" solo pueden ver la lista de usuarios, ver usuarios específicos, y editarse a
  a sí mismos (pero no cambiar su rol, desactivarse o borrarse).
</p>
<p>
  Además, todos los usuarios pueden acceder a la barra de búsqueda, que busca por nombre de usuario o correo electrónico.
</p>
<p>
  Algunos features faltantes podrían ser:
</p>
<ul>
  <li>
    Poder ver la contraseña al crear un usuario o cambiar de contraseña, y/o contar con un campo para repetir contraseña.
  </li>
  <li>
    Enviar correo electrónico de confirmación al crear un usuario, o al cambiar su correo electrónico
    (y sólo permitir la creación/cambio al clickear el enlace de confirmación).
  </li>
  <li>
    Un sistema más robusto de autorización, que implemente ACL.
  </li>
  <li>
    Implementar SASS para poder recompilar Bootstrap con personalizaciones.
  </li>
  <li>
    Implementar lodash/jQuery/Alpine para poder mejorar la UX.
    Por ejemplo autocompletar en la barra de búsqueda, auto-detectar nombres de usuario ya utilizados,
    animaciones, etc.
  </li>
  <li>
    Revisar y mejorar Pagination.
  </li>
</ul>

<p><strong>
  To-do list:
</strong></p>
<ul>
  <li>
    Validaciones (nombre de usuario, contraseña).
  </li>
  <li>
    Barra de búsqueda.
  </li>
  <li>
    Traducir strings faltantes.
  </li>
</ul>
