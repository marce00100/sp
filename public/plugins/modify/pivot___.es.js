(function() {
  var callWithJQuery;

  callWithJQuery = function(pivotModule) {
    if (typeof exports === "object" && typeof module === "object") {
      return pivotModule(require("jquery"));
    } else if (typeof define === "function" && define.amd) {
      return define(["jquery"], pivotModule);
    } else {
      return pivotModule(jQuery);
    }
  };

  callWithJQuery(function($) {
    var frFmt, frFmtInt, frFmtPct, nf, tpl;
    nf = $.pivotUtilities.numberFormat;
    tpl = $.pivotUtilities.aggregatorTemplates;
    frFmt = nf({
      thousandsSep: ".",
      decimalSep: ","
    });
    frFmtInt = nf({
      digitsAfterDecimal: 0,
      thousandsSep: ".",
      decimalSep: ","
    });
    frFmtPct = nf({
      digitsAfterDecimal: 1,
      scaler: 100,
      suffix: "%",
      thousandsSep: ".",
      decimalSep: ","
    });

    tpl.lili = function(formatter) {
        if (formatter == null) {
            formatter = usFmt;
        }
        return function(arg) {
            console.log(arg)
            var attr;
            attr = arg[0];
            return function(data, rowKey, colKey) {
                return {
                    sum: 0,
                    push: function(record) {
                      if (!isNaN(parseFloat(record[attr]))) {
                        return this.sum += parseFloat(record[attr]);
                      }
                    },
                    value: function() {
                      return this.sum;
                    },
                    format: formatter,
                    numInputs: attr != null ? 0 : 1
                };
            };
        };
    };
    return $.pivotUtilities.locales.es = {
      localeStrings: {
        renderError: "Ocurrió un error durante la interpretación de la tabla dinámica.",
        computeError: "Ocurrió un error durante el cálculo de la tabla dinámica.",
        uiRenderError: "Ocurrió un error durante el dibujado de la tabla dinámica.",
        selectAll: "Todos",
        selectNone: "Ninguno",
        tooMany: "(demasiados valores)",
        filterResults: "Filtrar",
        totals: "Totales",
        vs: "vs",
        by: "por",
        apply: "aplicar",
        cancel: "cerrar"
      },
      aggregators: {
        "Contar": tpl.count(frFmtInt),
        "Contar valores únicos": tpl.countUnique(frFmtInt),
        "Lista de valores únicos": tpl.listUnique(", "),
        "Suma": tpl.sum(frFmt),
        "Suma de enteros": tpl.sum(frFmtInt),
        "Promedio": tpl.average(frFmt),
        "Mínimo": tpl.min(frFmt),
        "Máximo": tpl.max(frFmt),
        "Indice  sum(a) / sum(b)": tpl.sumOverSum(frFmt),
        "Cota 80% superior": tpl.sumOverSumBound80(true, frFmt),
        "Cota 80% inferior": tpl.sumOverSumBound80(false, frFmt),
        "% part. en columna (suma)": tpl.fractionOf(tpl.sum(), "col", frFmtPct),
        "% part. en fila (suma)": tpl.fractionOf(tpl.sum(), "row", frFmtPct),
        "% part. del total (suma)": tpl.fractionOf(tpl.sum(), "total", frFmtPct),
        
        // "% participación del total (cuenta)": tpl.fractionOf(tpl.count(), "total", frFmtPct),
        // "% participación en fila (cuenta)": tpl.fractionOf(tpl.count(), "row", frFmtPct),
        // "% participación en columna (cuenta)": tpl.fractionOf(tpl.count(), "col", frFmtPct)
        
        "haber de prueba" : tpl.lili(frFmt),
        "suma valor" : function(){ return tpl.sum(frFmtInt)(['valor']) }
      },
      renderers: {
        "Tabla": $.pivotUtilities.renderers["Table"],
        "Tabla con barras": $.pivotUtilities.renderers["Table Barchart"],
        "Heatmap": $.pivotUtilities.renderers["Heatmap"],
        "Heatmap por filas": $.pivotUtilities.renderers["Row Heatmap"],
        "Heatmap por columnas": $.pivotUtilities.renderers["Col Heatmap"]
      }
    };
  });

}).call(this);

//# sourceMappingURL=pivot.es.js.map
