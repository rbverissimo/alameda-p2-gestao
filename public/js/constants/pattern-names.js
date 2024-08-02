import { LISTAR_TIPOS_TELEFONES } from "../routes.js";

const PREFIX_TIPO_PRESTADOR = 'tipo-prestador';
const PATTERN_NAME_TELEFONE = 'telefone-select';

const ROUTE_MAP = {
      [PATTERN_NAME_TELEFONE]: LISTAR_TIPOS_TELEFONES,
};


export function getRoute(routeName){
      return ROUTE_MAP[routeName];
}

