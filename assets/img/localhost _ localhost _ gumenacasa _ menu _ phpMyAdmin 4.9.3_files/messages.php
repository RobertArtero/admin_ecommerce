var PMA_messages = new Array();
PMA_messages['strConfirm'] = "Confirmar";
PMA_messages['strDoYouReally'] = "¿Realmente desea ejecutar \"%s\"?";
PMA_messages['strDropDatabaseStrongWarning'] = "¡Está a punto de DESTRUIR una base de datos completa!";
PMA_messages['strDatabaseRenameToSameName'] = "No puede renombrar la base de datos con el mismo nombre. Cambie el nombre e inténtelo de nuevo";
PMA_messages['strDropTableStrongWarning'] = "¡Está a punto de DESTRUIR una tabla completa!";
PMA_messages['strTruncateTableStrongWarning'] = "¡Está a punto de TRUNCAR una tabla completa!";
PMA_messages['strDeleteTrackingData'] = "¿Borrar los datos de seguimiento para esta tabla?";
PMA_messages['strDeleteTrackingDataMultiple'] = "¿Borrar los datos de seguimiento de estas tablas?";
PMA_messages['strDeleteTrackingVersion'] = "¿Borrar los datos de seguimiento de esta versión?";
PMA_messages['strDeleteTrackingVersionMultiple'] = "¿Borrar los datos de seguimiento de estas versiones?";
PMA_messages['strDeletingTrackingEntry'] = "¿Borrar entrada del informe de seguimiento?";
PMA_messages['strDeletingTrackingData'] = "Borrando los datos de seguimiento";
PMA_messages['strDroppingPrimaryKeyIndex'] = "Borrando Claves Primarias/Índice";
PMA_messages['strDroppingForeignKey'] = "Eliminando clave foránea.";
PMA_messages['strOperationTakesLongTime'] = "Esta operación podría llevar algún tiempo. ¿Proceder de todas formas?";
PMA_messages['strDropUserGroupWarning'] = "¿Realmente desea eliminar el grupo de usuarios \"%s\"?";
PMA_messages['strConfirmDeleteQBESearch'] = "¿Realmente desea eliminar la búsqueda \"%s\"?";
PMA_messages['strConfirmNavigation'] = "Tiene cambios sin guardar. ¿Está seguro que desea abandonar esta página?";
PMA_messages['strConfirmRowChange'] = "Está intentando reducir el número de filas, pero ya ha introducido datos en esas filas que se perderán. ¿Desea continuar?";
PMA_messages['strDropUserWarning'] = "¿Realmente desea eliminar el/los usuario/s seleccionado/s?";
PMA_messages['strDeleteCentralColumnWarning'] = "¿Realmente desea eliminar esta columna central?";
PMA_messages['strDropRTEitems'] = "¿Desea realmente borrar los items seleccionados?";
PMA_messages['strDropPartitionWarning'] = "¿Quieres SOLTAR las particiones seleccionadas? ¡También ELIMINARÁ los datos relacionados a las particiones seleccionadas!";
PMA_messages['strTruncatePartitionWarning'] = "¿Desea realmente TRUNCAR las particiones seleccionadas?";
PMA_messages['strRemovePartitioningWarning'] = "¿Desea realmente eliminar el particionado?";
PMA_messages['strResetSlaveWarning'] = "¿Realmente deseas ejecutar RESET SLAVE?";
PMA_messages['strChangeColumnCollation'] = "Esta operación intentará convertir los datos a la nueva intercalación. En casos raros, especialmente donde el personaje no existe en la nueva intercalación, este proceso podría causar que los datos aparecieran incorrectamente en la nueva intercalación; en este caso le sugerimos que revertir a la intercalación original y refiere a los consejos en <a href=\"%s\" target=\"garbled_data_wiki\">Datos confusos</a>.<br/><br/>¿Seguro que desea cambiar la intercalación y convertir los datos?";
PMA_messages['strChangeAllColumnCollationsWarning'] = "A través de esta operación, MySQL intenta asignar los valores de datos entre colaciones. Si los conjuntos de caracteres son incompatibles, puede haber pérdida de datos y esta pérdida de datos puede <b>NO</b> ser recuperable simplemente cambiando nuevamente la columna collation(s). <b>Para convertir los datos existentes, se sugiere utilizar la función de edición de las columnas (el Enlace de \"Cambio\") en la página de estructura de tabla.</b><br/><br/>¿Seguro que desea cambiar todas las columnas de intercalaciones y convertir los datos?";
PMA_messages['strSaveAndClose'] = "Guardar y Cerrar";
PMA_messages['strReset'] = "Reiniciar";
PMA_messages['strResetAll'] = "Reiniciar Todo";
PMA_messages['strFormEmpty'] = "¡Falta un valor en el formulario!";
PMA_messages['strRadioUnchecked'] = "¡Seleccione al menos una de estas opciones!";
PMA_messages['strEnterValidNumber'] = "¡Introduzca un número válido!";
PMA_messages['strEnterValidLength'] = "¡Introduzca una longitud válida!";
PMA_messages['strAddIndex'] = "Agregar índice";
PMA_messages['strEditIndex'] = "Editar Índice";
PMA_messages['strAddToIndex'] = "Agregar %s columna(s) al índice";
PMA_messages['strCreateSingleColumnIndex'] = "Crear índice de una sola columna";
PMA_messages['strCreateCompositeIndex'] = "Crear índice compuesto";
PMA_messages['strCompositeWith'] = "Componer con:";
PMA_messages['strMissingColumn'] = "Seleccione la(s) columna(s) para el índice.";
PMA_messages['strPreviewSQL'] = "Previsualizar SQL";
PMA_messages['strSimulateDML'] = "Simular consulta";
PMA_messages['strMatchedRows'] = "Filas encontradas:";
PMA_messages['strSQLQuery'] = "consulta SQL:";
PMA_messages['strYValues'] = "Valores Y";
PMA_messages['strEmptyQuery'] = "Por favor, introduzca primero la consulta SQL.";
PMA_messages['strHostEmpty'] = "¡El nombre del servidor está vacío!";
PMA_messages['strUserEmpty'] = "¡El nombre de usuario está vacío!";
PMA_messages['strPasswordEmpty'] = "¡La contraseña está vacía!";
PMA_messages['strPasswordNotSame'] = "¡Las contraseñas no coinciden!";
PMA_messages['strRemovingSelectedUsers'] = "Eliminando los usuarios seleccionados";
PMA_messages['strClose'] = "Cerrar";
PMA_messages['strTemplateCreated'] = "Plantilla creada.";
PMA_messages['strTemplateLoaded'] = "Plantilla cargada.";
PMA_messages['strTemplateUpdated'] = "Plantilla actualizada.";
PMA_messages['strTemplateDeleted'] = "Plantilla borrada.";
PMA_messages['strOther'] = "Otro";
PMA_messages['strThousandsSeparator'] = ",";
PMA_messages['strDecimalSeparator'] = ".";
PMA_messages['strChartConnectionsTitle'] = "Conexiones / Procesos";
PMA_messages['strIncompatibleMonitorConfig'] = "¡Configuración local de monitorización incompatible!";
PMA_messages['strIncompatibleMonitorConfigDescription'] = "La configuración de distribución de gráficos en el almacenamiento local del navegador no es compatible con la nueva versión del sistema de monitorización. Es probable que la configuración no funcione. Reinicie la configuración a la predeterminada en el menú <i>Configuración</i>.";
PMA_messages['strQueryCacheEfficiency'] = "Eficiencia del caché de consultas";
PMA_messages['strQueryCacheUsage'] = "Uso del caché de consultas";
PMA_messages['strQueryCacheUsed'] = "Caché de consultas utilizado";
PMA_messages['strSystemCPUUsage'] = "Uso de CPU del sistema";
PMA_messages['strSystemMemory'] = "Memoria de sistema";
PMA_messages['strSystemSwap'] = "Intercambio de sistema";
PMA_messages['strAverageLoad'] = "Carga promedio";
PMA_messages['strTotalMemory'] = "Memoria total";
PMA_messages['strCachedMemory'] = "Memoria caché";
PMA_messages['strBufferedMemory'] = "Memoria de búfers";
PMA_messages['strFreeMemory'] = "Memoria libre";
PMA_messages['strUsedMemory'] = "Memoria utilizada";
PMA_messages['strTotalSwap'] = "Intercambio Total";
PMA_messages['strCachedSwap'] = "Intercambio en Caché";
PMA_messages['strUsedSwap'] = "Intercambio Utilizado";
PMA_messages['strFreeSwap'] = "Intercambio Libre";
PMA_messages['strBytesSent'] = "Bytes enviados";
PMA_messages['strBytesReceived'] = "Bytes recibidos";
PMA_messages['strConnections'] = "Conexiones";
PMA_messages['strProcesses'] = "Procesos";
PMA_messages['strB'] = "B";
PMA_messages['strKiB'] = "KB";
PMA_messages['strMiB'] = "MB";
PMA_messages['strGiB'] = "GB";
PMA_messages['strTiB'] = "TB";
PMA_messages['strPiB'] = "PB";
PMA_messages['strEiB'] = "EB";
PMA_messages['strNTables'] = "%d tabla(s)";
PMA_messages['strQuestions'] = "Preguntas";
PMA_messages['strTraffic'] = "Tráfico";
PMA_messages['strSettings'] = "Configuración";
PMA_messages['strAddChart'] = "Agregar gráfico a la grilla";
PMA_messages['strAddOneSeriesWarning'] = "¡Introduzca una longitud válida!";
PMA_messages['strNone'] = "Ninguna";
PMA_messages['strResumeMonitor'] = "Reanudar monitorización";
PMA_messages['strPauseMonitor'] = "Pausar monitorización";
PMA_messages['strStartRefresh'] = "Iniciar refresco automático";
PMA_messages['strStopRefresh'] = "Detener refresco automático";
PMA_messages['strBothLogOn'] = "«general_log» y «slow_query_log» activos.";
PMA_messages['strGenLogOn'] = "«general_log» activo.";
PMA_messages['strSlowLogOn'] = "«slow_query_log» activo.";
PMA_messages['strBothLogOff'] = "«slow_query_log» y «general_log» desactivados.";
PMA_messages['strLogOutNotTable'] = "«log_output» no está definido como TABLE.";
PMA_messages['strLogOutIsTable'] = "«log_output» está definido como TABLE.";
PMA_messages['strSmallerLongQueryTimeAdvice'] = "«slow_query_log» activo, pero el servidor sólo registra consultas que tardan más de %d segundos. Es recomendable configurar «long_query_time» entre 0 y 2 segundos dependiendo del equipo.";
PMA_messages['strLongQueryTimeSet'] = "«long_query_time» está configurado a %d segundo(s).";
PMA_messages['strSettingsAppliedGlobal'] = "Las siguientes configuraciones serán aplicadas globalmente y volverán a sus valores predeterminados al reiniciar el servidor:";
PMA_messages['strSetLogOutput'] = "Configurar «log_output» a %s";
PMA_messages['strEnableVar'] = "Habilitar %s";
PMA_messages['strDisableVar'] = "Deshabilitar %s";
PMA_messages['setSetLongQueryTime'] = "Definir «long_query_time» a %d segundos.";
PMA_messages['strNoSuperUser'] = "No posee permisos para cambiar estas variables. Inicie sesión con la cuenta root o contacte a su administrador de base de datos.";
PMA_messages['strChangeSettings'] = "Cambiar configuraciones";
PMA_messages['strCurrentSettings'] = "Configuraciones actuales";
PMA_messages['strChartTitle'] = "Título del gráfico";
PMA_messages['strDifferential'] = "Diferencial";
PMA_messages['strDividedBy'] = "Dividido por %s";
PMA_messages['strUnit'] = "Unidad";
PMA_messages['strFromSlowLog'] = "Del registro de consultas lentas";
PMA_messages['strFromGeneralLog'] = "Del registro general";
PMA_messages['strServerLogError'] = "Se desconoce el nombre de la base de datos para esta consulta en los registros del servidor.";
PMA_messages['strAnalysingLogsTitle'] = "Analizando registros";
PMA_messages['strAnalysingLogs'] = "Analizando y cargando registros. Esto puede demorar.";
PMA_messages['strCancelRequest'] = "Cancelar petición";
PMA_messages['strCountColumnExplanation'] = "Esta columna muestra la cantidad de consultas idénticas que fueron agrupadas. Sin embargo, sólo la consulta SQL en sí es es utilizada para agrupar, por lo que los demás atributos de las consultas como el tiempo de inicio podría diferir.";
PMA_messages['strMoreCountColumnExplanation'] = "Dado que se eligió agrupar consultas INSERT, las consultas INSERT a la misma tabla también fueron agrupadas sin importar los datos agregados.";
PMA_messages['strLogDataLoaded'] = "Los datos del registros fueron cargados. Consultas ejecutadas en este período de tiempo:";
PMA_messages['strJumpToTable'] = "Saltar a la tabla de registros";
PMA_messages['strNoDataFoundTitle'] = "No se encontraron datos";
PMA_messages['strNoDataFound'] = "Registros analizados, pero no se encontraron datos en este período de tiempo.";
PMA_messages['strAnalyzing'] = "Analizando…";
PMA_messages['strExplainOutput'] = "Explicar salida";
PMA_messages['strStatus'] = "Estado actual";
PMA_messages['strTime'] = "Tiempo";
PMA_messages['strTotalTime'] = "Tiempo total:";
PMA_messages['strProfilingResults'] = "Perfilando resultados";
PMA_messages['strTable'] = "Tabla";
PMA_messages['strChart'] = "Gráfico";
PMA_messages['strAliasDatabase'] = "Base de datos";
PMA_messages['strAliasTable'] = "Tabla";
PMA_messages['strAliasColumn'] = "Columna";
PMA_messages['strFiltersForLogTable'] = "Opciones de filtros para tablas de registros";
PMA_messages['strFilter'] = "Filtrar";
PMA_messages['strFilterByWordRegexp'] = "Filtrar consultas por palabra/expresión regular:";
PMA_messages['strIgnoreWhereAndGroup'] = "Agrupar consultas ignorando datos variables en sentencias WHERE";
PMA_messages['strSumRows'] = "Suma de filas agrupadas:";
PMA_messages['strTotal'] = "Total:";
PMA_messages['strLoadingLogs'] = "Cargando registros";
PMA_messages['strRefreshFailed'] = "Falló la actualización del monitorizador";
PMA_messages['strInvalidResponseExplanation'] = "Al pedir un nuevo gráfico el servidor devolvió una respuesta inválida. Esto es probablemente porque expiró la sesión. Cargar la página nuevamente y volver a introducir sus credenciales debería ayudar.";
PMA_messages['strReloadPage'] = "Cargar página nuevamente";
PMA_messages['strAffectedRows'] = "Filas afectadas:";
PMA_messages['strFailedParsingConfig'] = "No se pudo analizar el archivo de configuración. No parece ser código JSON válido.";
PMA_messages['strFailedBuildingGrid'] = "No se pudo crear la grilla de gráficos con la configuración importada. Reiniciando a configuración predeterminada…";
PMA_messages['strImport'] = "Importar";
PMA_messages['strImportDialogTitle'] = "Importar configuración";
PMA_messages['strImportDialogMessage'] = "Seleccione el archivo que desea importar.";
PMA_messages['strNoImportFile'] = "¡No existen archivos disponibles en el servidor para importar!";
PMA_messages['strAnalyzeQuery'] = "Analizar Consulta";
PMA_messages['strAdvisorSystem'] = "Sistema de consejos";
PMA_messages['strPerformanceIssues'] = "Posibles problemas de performance";
PMA_messages['strIssuse'] = "Problema";
PMA_messages['strRecommendation'] = "Recomendación";
PMA_messages['strRuleDetails'] = "Detalles de la regla";
PMA_messages['strJustification'] = "Justificación";
PMA_messages['strFormula'] = "Variable/fórmula utilizada";
PMA_messages['strTest'] = "Prueba";
PMA_messages['strFormatting'] = "Formato SQL…";
PMA_messages['strNoParam'] = "¡Sin parámetros encontrados!";
PMA_messages['strGo'] = "Continuar";
PMA_messages['strCancel'] = "Cancelar";
PMA_messages['strPageSettings'] = "Ajustes de página relacionada";
PMA_messages['strApply'] = "Aplicar";
PMA_messages['strLoading'] = "Cargando…";
PMA_messages['strAbortedRequest'] = "¡¡Petición Abortada!!";
PMA_messages['strProcessingRequest'] = "Procesando petición";
PMA_messages['strRequestFailed'] = "¡¡Petición Fallida!!";
PMA_messages['strErrorProcessingRequest'] = "Error al procesar la petición";
PMA_messages['strErrorCode'] = "Código de error: %s";
PMA_messages['strErrorText'] = "Texto de error: %s";
PMA_messages['strErrorConnection'] = "Parece que se ha perdido la conexión con el servidor. Por favor, compruebe su conexión de red y el estado del servidor.";
PMA_messages['strNoDatabasesSelected'] = "No se seleccionaron bases de datos.";
PMA_messages['strNoAccountSelected'] = "No se seleccionaron cuentas.";
PMA_messages['strDroppingColumn'] = "Eliminando columna";
PMA_messages['strAddingPrimaryKey'] = "Añadiendo clave primaria";
PMA_messages['strOK'] = "OK";
PMA_messages['strDismiss'] = "Pulse para descartar esta notificación";
PMA_messages['strRenamingDatabases'] = "Renombrando bases de datos";
PMA_messages['strCopyingDatabase'] = "Copiando base de datos";
PMA_messages['strChangingCharset'] = "Cambiando el juego de caracteres";
PMA_messages['strNo'] = "No";
PMA_messages['strForeignKeyCheck'] = "Habilite la revisión de las claves foráneas";
PMA_messages['strErrorRealRowCount'] = "No se pudo obtener la cantidad de filas real.";
PMA_messages['strSearching'] = "Buscando";
PMA_messages['strHideSearchResults'] = "Ocultar resultados de búsqueda";
PMA_messages['strShowSearchResults'] = "Mostrar resultados de búsqueda";
PMA_messages['strBrowsing'] = "Examinando";
PMA_messages['strDeleting'] = "Borrando";
PMA_messages['strConfirmDeleteResults'] = "¿Eliminar las coincidencias para la tabla %s?";
PMA_messages['MissingReturn'] = "¡La definición de una función almacenada debe contener una sentencia RETURN!";
PMA_messages['strExport'] = "Exportar";
PMA_messages['NoExportable'] = "No se puede exportar ninguna rutina. Quizá falten los privilegios necesarios.";
PMA_messages['enum_editor'] = "Editor de ENUM/SET";
PMA_messages['enum_columnVals'] = "Valores para la columna %s";
PMA_messages['enum_newColumnVals'] = "Valores para una nueva columna";
PMA_messages['enum_hint'] = "Introducir cada valor en un campo separado.";
PMA_messages['enum_addValue'] = "Agregar %d valor(es)";
PMA_messages['strImportCSV'] = "Nota: si la fila contiene múltiples tablas, van a ser combinadas en una.";
PMA_messages['strHideQueryBox'] = "Ocultar ventana de consultas SQL";
PMA_messages['strShowQueryBox'] = "Mostrar ventana de consultas SQL";
PMA_messages['strEdit'] = "Editar";
PMA_messages['strDelete'] = "Borrar";
PMA_messages['strNotValidRowNumber'] = "%d no es un número de fila válido.";
PMA_messages['strBrowseForeignValues'] = "Mostrar los valores foráneos";
PMA_messages['strNoAutoSavedQuery'] = "Sin consultas almacenadas automáticamente";
PMA_messages['strBookmarkVariable'] = "Variable %d:";
PMA_messages['pickColumn'] = "Elegir";
PMA_messages['pickColumnTitle'] = "Selección de columnas";
PMA_messages['searchList'] = "Buscar en esta lista";
PMA_messages['strEmptyCentralList'] = "No hay columnas en la lista central. Asegúrese que la lista central de  columnas para la base de datos %s tenga columnas que no estén en la tabla actual.";
PMA_messages['seeMore'] = "Más";
PMA_messages['confirmTitle'] = "¿Está seguro?";
PMA_messages['makeConsistentMessage'] = "Esta acción puede cambiar la definición de algunas columnas.<br />¿Está seguro que desea continuar?";
PMA_messages['strContinue'] = "Continuar";
PMA_messages['strAddPrimaryKey'] = "Agregar clave primaria";
PMA_messages['strPrimaryKeyAdded'] = "Se agregó la clave primaria.";
PMA_messages['strToNextStep'] = "Llevándolo al siguiente paso…";
PMA_messages['strFinishMsg'] = "Se completó el primer paso de la normalización para la tabla \'%s\'.";
PMA_messages['strEndStep'] = "Final de los pasos";
PMA_messages['str2NFNormalization'] = "Segundo paso de normalización (2NF)";
PMA_messages['strDone'] = "Terminado";
PMA_messages['strConfirmPd'] = "Confirmar dependencias parciales";
PMA_messages['strSelectedPd'] = "Las dependencias parciales seleccionadas son:";
PMA_messages['strPdHintNote'] = "Nota: «a, b -> d, f» implica que los valores combinados de las columnas a y b pueden determinar el valor de las columnas d y f.";
PMA_messages['strNoPdSelected'] = "¡No se seleccionaron dependencias parciales!";
PMA_messages['strBack'] = "Volver";
PMA_messages['strShowPossiblePd'] = "Mostrar las posibles dependencias parciales basadas en los datos actuales de la tabla";
PMA_messages['strHidePd'] = "Esconder lista de dependencias parciales";
PMA_messages['strWaitForPd'] = "¡Paciencia! Puede tomar unos segundos, dependiendo del tamaño de los datos y la cantidad de columnas de la tabla.";
PMA_messages['strStep'] = "Paso";
PMA_messages['strMoveRepeatingGroup'] = "<ol><b>Se realizarán las siguientes acciones:</b><li>Eliminar columnas %s de la tabla %s</li><li>Crear la siguiente tabla</li>";
PMA_messages['strNewTablePlaceholder'] = "Enter new table name";
PMA_messages['strNewColumnPlaceholder'] = "Enter column name";
PMA_messages['str3NFNormalization'] = "Tercer paso de la normalización (3NF)";
PMA_messages['strConfirmTd'] = "Confirmar dependencias transitivas";
PMA_messages['strSelectedTd'] = "Las dependencias seleccionadas son:";
PMA_messages['strNoTdSelected'] = "¡No se seleccionaron dependencias!";
PMA_messages['strSave'] = "Guardar";
PMA_messages['strHideSearchCriteria'] = "Ocultar criterio de búsqueda";
PMA_messages['strShowSearchCriteria'] = "Mostrar criterio de búsqueda";
PMA_messages['strRangeSearch'] = "Búsqueda por rango";
PMA_messages['strColumnMax'] = "Máximo de las columnas:";
PMA_messages['strColumnMin'] = "Mínimo de las columnas:";
PMA_messages['strMinValue'] = "Valor mínimo:";
PMA_messages['strMaxValue'] = "Valor máximo:";
PMA_messages['strHideFindNReplaceCriteria'] = "Ocultar criterio de búsqueda y reemplazo";
PMA_messages['strShowFindNReplaceCriteria'] = "Mostrar criterio de búsqueda y reemplazo";
PMA_messages['strDisplayHelp'] = "<ul><li>Cada punto representa una fila de datos.</li><li>Ubicar el cursor sobre un punto mostrará su etiqueta.</li><li>Para ampliar, seleccione el gráfico.</li><li>Pulse el botón de restaurar ampliación para volver al estado original.</li><li>Pulse en un punto de datos para ver y posiblemente editar la fila de datos.</li><li>El gráfico puede redimensionarse arrastrando la esquina inferior derecha.</li></ul>";
PMA_messages['strHelpTitle'] = "Zoom search instructions";
PMA_messages['strInputNull'] = "<strong>Seleccionar dos columnas</strong>";
PMA_messages['strSameInputs'] = "<strong>Seleccionar dos columnas distintas</strong>";
PMA_messages['strDataPointContent'] = "Contenido del punto de datos";
PMA_messages['strIgnore'] = "Ignorar";
PMA_messages['strCopy'] = "Copiar";
PMA_messages['strX'] = "X";
PMA_messages['strY'] = "Y";
PMA_messages['strPoint'] = "Punto";
PMA_messages['strPointN'] = "Punto %d";
PMA_messages['strLineString'] = "Cadena de líneas";
PMA_messages['strPolygon'] = "Polígono";
PMA_messages['strGeometry'] = "Geometría";
PMA_messages['strInnerRing'] = "Círculo interior";
PMA_messages['strOuterRing'] = "Círculo exterior";
PMA_messages['strAddPoint'] = "Agregar un punto";
PMA_messages['strAddInnerRing'] = "Agregar un círculo interior";
PMA_messages['strYes'] = "Sí";
PMA_messages['strCopyEncryptionKey'] = "¿Desea copiar la llave de cifrado?";
PMA_messages['strEncryptionKey'] = "Llave de cifrado";
PMA_messages['strMysqlAllowedValuesTipTime'] = "MySQL acepta valores adicionales que no se pueden seleccionar en el deslizador; introduzca esos valores directamente si lo desea";
PMA_messages['strMysqlAllowedValuesTipDate'] = "MySQL acepta valores adicionales que no se pueden seleccionar en el calendario; introduzca esos valores directamente si lo desea";
PMA_messages['strLockToolTip'] = "Indica que ha realizado cambios en esta página; se le pedirá confirmación antes de abandonar los cambios";
PMA_messages['strSelectReferencedKey'] = "Seleccione la clave referenciada";
PMA_messages['strSelectForeignKey'] = "Seleccione la clave foránea";
PMA_messages['strPleaseSelectPrimaryOrUniqueKey'] = "¡Seleccione la clave primaria o una clave única!";
PMA_messages['strChangeDisplay'] = "Elegir la columna a mostrar";
PMA_messages['strLeavingDesigner'] = "No se guardaron los cambios en la disposición. Serán perdidos si no los guardas. ¿Deseas continuar?";
PMA_messages['strQueryEmpty'] = "valor/subconsulta está vacío";
PMA_messages['strAddTables'] = "Añadir tablas de otras bases de datos";
PMA_messages['strPageName'] = "Nombre de página";
PMA_messages['strSavePage'] = "Guardar página";
PMA_messages['strSavePageAs'] = "Guardar página como";
PMA_messages['strOpenPage'] = "Abrir página";
PMA_messages['strDeletePage'] = "Borrar página";
PMA_messages['strUntitled'] = "Sin título";
PMA_messages['strSelectPage'] = "Seleccione una página para continuar";
PMA_messages['strEnterValidPageName'] = "Introduzca un nombre de página válido";
PMA_messages['strLeavingPage'] = "¿Desea guardar los cambios en la página actual?";
PMA_messages['strSuccessfulPageDelete'] = "Página eliminada exitosamente";
PMA_messages['strExportRelationalSchema'] = "Exportar esquema relacional";
PMA_messages['strModificationSaved'] = "Se han guardado las modificaciones";
PMA_messages['strObjectsCreated'] = "%d objeto(s) creado(s).";
PMA_messages['strColumnName'] = "Column name";
PMA_messages['strSubmit'] = "Enviar";
PMA_messages['strCellEditHint'] = "Presione la tecla de escape para cancelar la edición.";
PMA_messages['strSaveCellWarning'] = "Editó datos que no fueron guardados. ¿Está seguro que desea abandonar esta página sin guardar los datos?";
PMA_messages['strColOrderHint'] = "Arrastrar para reordenar.";
PMA_messages['strSortHint'] = "Pulse para ordenar los resultados según esta columna.";
PMA_messages['strMultiSortHint'] = "Pulsar Shift+Click para agregar esta columna a la cláusula «ORDER BY» o intercambiar entre ASC/DESC.<br />- Pulsar Ctrl+Click o Alt+Click (Mac: Shift+Option+Click) para eliminar la columna de la cláusula «ORDER BY»";
PMA_messages['strColMarkHint'] = "Pulsar para marcar/desmarcar.";
PMA_messages['strColNameCopyHint'] = "Haga doble click para copiar el nombre de la columna.";
PMA_messages['strColVisibHint'] = "Pulsa la flecha de la lista desplegable <br />para conmutar la visibilidad de la columna.";
PMA_messages['strShowAllCol'] = "Mostrar todo";
PMA_messages['strAlertNonUnique'] = "Esta tabla no contiene una columna única. Funcionalidades relacionadas con la edición de la grilla y los enlaces de copiado, eliminación y edición pueden no funcionar luego de guardar.";
PMA_messages['strEnterValidHex'] = "Introduzca una cadena hexadecimal válida. Los carácteres válidos son 0-9 y A-F.";
PMA_messages['strShowAllRowsWarning'] = "¿Realmente desea ver todas las filas? Una tabla grande podría afectar el funcionamiento del navegador.";
PMA_messages['strOriginalLength'] = "Longitud original";
PMA_messages['dropImportMessageCancel'] = "cancelar";
PMA_messages['dropImportMessageAborted'] = "Abortado";
PMA_messages['dropImportMessageFailed'] = "falló";
PMA_messages['dropImportMessageSuccess'] = "Éxito";
PMA_messages['dropImportImportResultHeader'] = "Estado de la importación";
PMA_messages['dropImportDropFiles'] = "Suelte aquí los archivos";
PMA_messages['dropImportSelectDB'] = "Seleccionar base de datos primero";
PMA_messages['print'] = "Imprimir";
PMA_messages['back'] = "Volver";
PMA_messages['strGridEditFeatureHint'] = "También puede editar la mayoría de los valores<br />con un pulsado doble directamente en su contenido.";
PMA_messages['strGoToLink'] = "Ir al enlace:";
PMA_messages['strColNameCopyTitle'] = "Copie el nombre de la columna.";
PMA_messages['strColNameCopyText'] = "Haga click con el botón derecho sobre la columna para copiarla en el portapapeles.";
PMA_messages['strGeneratePassword'] = "Generar contraseña";
PMA_messages['strGenerate'] = "Generar";
PMA_messages['strChangePassword'] = "Cambio de contraseña";
PMA_messages['strMore'] = "Más";
PMA_messages['strShowPanel'] = "Mostrar panel";
PMA_messages['strHidePanel'] = "Ocultar panel";
PMA_messages['strUnhideNavItem'] = "Mostrar los elementos escondidos del árbol de navegación.";
PMA_messages['linkWithMain'] = "Enlace al panel principal";
PMA_messages['unlinkWithMain'] = "Deshacer enlace en el panel principal";
PMA_messages['strInvalidPage'] = "La página solicitada no se encontró en el historial, puede haber expirado.";
PMA_messages['strNewerVersion'] = "Una versión más reciente de phpMyAdmin está disponible y le recomendamos que la obtenga. La versión más reciente es %s, y existe desde el %s.";
PMA_messages['strLatestAvailable'] = ", versión estable más reciente:";
PMA_messages['strUpToDate'] = "actualizada";
PMA_messages['strCreateView'] = "Crear vista";
PMA_messages['strSendErrorReport'] = "Enviar informe de error";
PMA_messages['strSubmitErrorReport'] = "Enviar informe de error";
PMA_messages['strErrorOccurred'] = "Ocurrió un error fatal en JavaScript. ¿Desearía enviar un reporte de error?";
PMA_messages['strChangeReportSettings'] = "Cambiar configuraciones del informe";
PMA_messages['strShowReportDetails'] = "Mostrar detalles del informe";
PMA_messages['strTimeOutError'] = "¡La exportación está incompleta debido a un límite en el tiempo de ejecución demasiado bajo a nivel de PHP!";
PMA_messages['strTooManyInputs'] = "Advertencia: un formulario en esta página tiene más de %d campos. Al enviarlo se podrían ignorar algunos campos debido a la configuración «max_input_vars» de PHP.";
PMA_messages['phpErrorsFound'] = "<div class=\"error\">¡Se detectaron algunos errores en el servidor!<br/>Revise el pie de esta ventana.<div><input id=\"pma_ignore_errors_popup\" type=\"submit\" value=\"Ignorar\" class=\"floatright message_errors_found\"><input id=\"pma_ignore_all_errors_popup\" type=\"submit\" value=\"Ignorar todos\" class=\"floatright message_errors_found\"></div></div>";
PMA_messages['phpErrorsBeingSubmitted'] = "<div class=\"error\">¡Se detectaron algunos errores en el servidor!<br/>Un momento, se están enviando en este momento debido a su configuración.<br/><img src=\"./themes/original/img/ajax_clock_small.gif\" width=\"16\" height=\"16\" alt=\"ajax clock\"/></div>";
PMA_messages['strConsoleRequeryConfirm'] = "¿Ejecutar esta consulta nuevamente?";
PMA_messages['strConsoleDeleteBookmarkConfirm'] = "¿Realmente desea eliminar este favorito?";
PMA_messages['strConsoleDebugError'] = "Ocurrió un error al obtener información de depuración SQL.";
PMA_messages['strConsoleDebugSummary'] = "%s consultas ejecutadas %s veces en %s segundos.";
PMA_messages['strConsoleDebugArgsSummary'] = "%s argumento(s) correcto(s)";
PMA_messages['strConsoleDebugShowArgs'] = "Mostrar argumentos";
PMA_messages['strConsoleDebugHideArgs'] = "Ocultar argumentos";
PMA_messages['strConsoleDebugTimeTaken'] = "Tiempo necesario:";
PMA_messages['strNoLocalStorage'] = "Hubo un problema accediendo al almacenamiento del navegador, algunas características no funcionan adecuadamente para usted. Es probable que el navegador no soporte el almacenamiento de información o se alcanzó el límite de cuota. En Firefox, el almacenamiento corrupto también puede causar problemas, limpiar sus \"Datos offline de sitios web\"  puede ayudar. En Safari, este problema es causado comúnmente por la \"Navegación en modo privado\".";
PMA_messages['strCopyTablesTo'] = "Copiar tablas a";
PMA_messages['strAddPrefix'] = "Agregar prefijo a la tabla";
PMA_messages['strReplacePrefix'] = "Reemplazar tabla con el prefijo";
PMA_messages['strCopyPrefix'] = "Copiar tabla con prefijo";
PMA_messages['strExtrWeak'] = "Extremadamente débil";
PMA_messages['strVeryWeak'] = "Muy débil";
PMA_messages['strWeak'] = "Débil";
PMA_messages['strGood'] = "Bueno";
PMA_messages['strStrong'] = "Fuerte";
PMA_messages['strU2FTimeout'] = "Se acabó el tiempo de espera para la activación de la clave de seguridad.";
PMA_messages['strU2FError'] = "Ha fallado la activación de la llave de seguridad (%s).";
PMA_messages['strTableAlreadyExists'] = "Table %s already exists!";
PMA_messages['strHide'] = "Ocultar";
PMA_messages['strStructure'] = "Estructura";
var themeCalendarImage = './themes/original/img/b_calendar.png';
var pmaThemeImage = './themes/original/img/';
var mysql_doc_template = './url.php?url=https%3A%2F%2Fdev.mysql.com%2Fdoc%2Frefman%2F5.5%2Fen%2F%25s.html';
var maxInputVars = 1000;
if ($.datepicker) {
$.datepicker.regional['']['closeText'] = "Terminado";
$.datepicker.regional['']['prevText'] = "Anterior";
$.datepicker.regional['']['nextText'] = "Siguiente";
$.datepicker.regional['']['currentText'] = "Hoy";
$.datepicker.regional['']['monthNames'] = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre",];
$.datepicker.regional['']['monthNamesShort'] = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic",];
$.datepicker.regional['']['dayNames'] = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado",];
$.datepicker.regional['']['dayNamesShort'] = ["Dom","Lun","Mar","Mie","Jue","Vie","Sab",];
$.datepicker.regional['']['dayNamesMin'] = ["Do","Lu","Ma","Mi","Ju","Vi","Sa",];
$.datepicker.regional['']['weekHeader'] = "Sem";
$.datepicker.regional['']['showMonthAfterYear'] = true;
$.datepicker.regional['']['yearSuffix'] = "";
$.extend($.datepicker._defaults, $.datepicker.regional['']);
} /* if ($.datepicker) */

if ($.timepicker) {
$.timepicker.regional['']['timeText'] = "Tiempo";
$.timepicker.regional['']['hourText'] = "Hora";
$.timepicker.regional['']['minuteText'] = "Minuto";
$.timepicker.regional['']['secondText'] = "Segundo";
$.extend($.timepicker._defaults, $.timepicker.regional['']);
} /* if ($.timepicker) */

function extendingValidatorMessages() {
$.extend($.validator.messages, {
required: "Este campo es requerido", remote: "Corrige este campo", email: "Ingrese un correo electrónico válido", url: "Ingrese una URL válida", date: "Ingrese una fecha válida", dateISO: "Ingrese una fecha ( ISO ) válida", number: "Ingrese un número válido", creditcard: "Ingrese un número de tarjeta de crédito valido", digits: "Ingrese solo dígitos", equalTo: "Ingrese el mismo valor de nuevo", maxlength: $.validator.format("Ingrese no más de {0} caracteres"), minlength: $.validator.format("Ingrese al menos {0} caracteres"), rangelength: $.validator.format("Ingrese un valor entre {0} y {1} caracteres de largo"), range: $.validator.format("Ingrese un valor entre {0} y {1}"), max: $.validator.format("Ingrese un valor menor o igual a {0}"), min: $.validator.format("Ingrese un valor mayor o igual a {0}"), validationFunctionForDateTime: $.validator.format("Ingrese una fecha u hora válida"), validationFunctionForHex: $.validator.format("Ingrese una entrada HEX válida"), validationFunctionForFuns: $.validator.format("Error")
});
} /* if ($.validator) */