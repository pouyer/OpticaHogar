/**
 * Funciones JavaScript para carga dinámica de ubicaciones geográficas
 * Incluir este archivo en las vistas que necesiten sincronización de país/departamento/municipio
 */

/**
 * Carga departamentos según el país seleccionado
 * @param {number} paisId - ID del país
 * @param {string} deptoSelectId - ID del select de departamentos
 * @param {string} muniSelectId - ID del select de municipios
 * @param {string} localSelectId - ID del select de localidades
 * @param {number} valorPreseleccionado - (Opcional) Valor a preseleccionar después de cargar
 * @returns {Promise} Promise que se resuelve cuando los datos se cargan
 */
function cargarDepartamentos(paisId, deptoSelectId, muniSelectId, localSelectId, valorPreseleccionado = null) {
    return new Promise((resolve, reject) => {
        const deptoSelect = document.getElementById(deptoSelectId);
        const muniSelect = document.getElementById(muniSelectId);
        const localSelect = document.getElementById(localSelectId);

        // Limpiar selects dependientes
        deptoSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
        if (muniSelect) muniSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
        if (localSelect) localSelect.innerHTML = '<option value="">-- Seleccionar --</option>';

        if (!paisId) {
            resolve();
            return;
        }

        // Mostrar loading
        deptoSelect.innerHTML = '<option value="">Cargando...</option>';
        deptoSelect.disabled = true;

        fetch(`../ajax/cargar_ubicaciones.php?action=departamentos&pais_id=${paisId}`)
            .then(response => response.json())
            .then(data => {
                deptoSelect.disabled = false;

                if (data.success && data.data) {
                    deptoSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
                    data.data.forEach(depto => {
                        const option = document.createElement('option');
                        option.value = depto.id;
                        option.textContent = depto.nombre;
                        deptoSelect.appendChild(option);
                    });

                    // Preseleccionar valor si se proporcionó
                    if (valorPreseleccionado) {
                        deptoSelect.value = valorPreseleccionado;
                    }

                    resolve();
                } else {
                    deptoSelect.innerHTML = '<option value="">Error al cargar</option>';
                    console.error('Error:', data.error || 'Error desconocido');
                    reject(data.error || 'Error desconocido');
                }
            })
            .catch(error => {
                deptoSelect.disabled = false;
                deptoSelect.innerHTML = '<option value="">Error de conexión</option>';
                console.error('Error al cargar departamentos:', error);
                reject(error);
            });
    });
}

/**
 * Carga municipios según el departamento seleccionado
 * @param {number} deptoId - ID del departamento
 * @param {string} muniSelectId - ID del select de municipios
 * @param {string} localSelectId - ID del select de localidades
 * @param {number} valorPreseleccionado - (Opcional) Valor a preseleccionar después de cargar
 * @returns {Promise} Promise que se resuelve cuando los datos se cargan
 */
function cargarMunicipios(deptoId, muniSelectId, localSelectId, valorPreseleccionado = null) {
    return new Promise((resolve, reject) => {
        const muniSelect = document.getElementById(muniSelectId);
        const localSelect = document.getElementById(localSelectId);

        // Limpiar selects dependientes
        muniSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
        if (localSelect) localSelect.innerHTML = '<option value="">-- Seleccionar --</option>';

        if (!deptoId) {
            resolve();
            return;
        }

        // Mostrar loading
        muniSelect.innerHTML = '<option value="">Cargando...</option>';
        muniSelect.disabled = true;

        fetch(`../ajax/cargar_ubicaciones.php?action=municipios&departamento_id=${deptoId}`)
            .then(response => response.json())
            .then(data => {
                muniSelect.disabled = false;

                if (data.success && data.data) {
                    muniSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
                    data.data.forEach(muni => {
                        const option = document.createElement('option');
                        option.value = muni.id;
                        option.textContent = muni.nombre;
                        muniSelect.appendChild(option);
                    });

                    // Preseleccionar valor si se proporcionó
                    if (valorPreseleccionado) {
                        muniSelect.value = valorPreseleccionado;
                    }

                    resolve();
                } else {
                    muniSelect.innerHTML = '<option value="">Error al cargar</option>';
                    console.error('Error:', data.error || 'Error desconocido');
                    reject(data.error || 'Error desconocido');
                }
            })
            .catch(error => {
                muniSelect.disabled = false;
                muniSelect.innerHTML = '<option value="">Error de conexión</option>';
                console.error('Error al cargar municipios:', error);
                reject(error);
            });
    });
}

/**
 * Carga localidades según el municipio seleccionado
 * @param {number} muniId - ID del municipio
 * @param {string} localSelectId - ID del select de localidades
 * @param {number} valorPreseleccionado - (Opcional) Valor a preseleccionar después de cargar
 * @returns {Promise} Promise que se resuelve cuando los datos se cargan
 */
function cargarLocalidades(muniId, localSelectId, valorPreseleccionado = null) {
    return new Promise((resolve, reject) => {
        const localSelect = document.getElementById(localSelectId);

        // Limpiar select
        localSelect.innerHTML = '<option value="">-- Seleccionar --</option>';

        if (!muniId) {
            resolve();
            return;
        }

        // Mostrar loading
        localSelect.innerHTML = '<option value="">Cargando...</option>';
        localSelect.disabled = true;

        fetch(`../ajax/cargar_ubicaciones.php?action=localidades&municipio_id=${muniId}`)
            .then(response => response.json())
            .then(data => {
                localSelect.disabled = false;

                if (data.success && data.data) {
                    localSelect.innerHTML = '<option value="">-- Seleccionar --</option>';
                    data.data.forEach(local => {
                        const option = document.createElement('option');
                        option.value = local.id;
                        option.textContent = local.nombre;
                        localSelect.appendChild(option);
                    });

                    // Preseleccionar valor si se proporcionó
                    if (valorPreseleccionado) {
                        localSelect.value = valorPreseleccionado;
                    }

                    resolve();
                } else {
                    localSelect.innerHTML = '<option value="">Error al cargar</option>';
                    console.error('Error:', data.error || 'Error desconocido');
                    reject(data.error || 'Error desconocido');
                }
            })
            .catch(error => {
                localSelect.disabled = false;
                localSelect.innerHTML = '<option value="">Error de conexión</option>';
                console.error('Error al cargar localidades:', error);
                reject(error);
            });
    });
}
