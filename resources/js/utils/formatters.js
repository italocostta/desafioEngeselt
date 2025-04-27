// resources/js/utils/formatters.js

/**
 * Formata um número de telefone brasileiro.
 * Exemplo: (83) 99999-9999
 */
export function formatarTelefone(telefone) {
    if (!telefone) return ''
  
    telefone = telefone.replace(/\D/g, '')
  
    if (telefone.length === 11) {
      return `(${telefone.substring(0, 2)}) ${telefone.substring(2, 7)}-${telefone.substring(7)}`
    }
  
    if (telefone.length === 10) {
      return `(${telefone.substring(0, 2)}) ${telefone.substring(2, 6)}-${telefone.substring(6)}`
    }
  
    return telefone
  }
  
  /**
   * Formata um número de CEP brasileiro.
   * Exemplo: 58052-240
   */
  export function formatarCep(cep) {
    if (!cep) return ''
  
    cep = cep.replace(/\D/g, '')
  
    if (cep.length === 8) {
      return `${cep.substring(0, 5)}-${cep.substring(5)}`
    }
  
    return cep
  }
  
  /**
   * Formata um número para moeda Real (R$).
   * Exemplo: R$ 1.234,56
   */
  export function formatarMoeda(valor) {
    if (valor === null || valor === undefined || valor === '') return ''
  
    return Number(valor).toLocaleString('pt-BR', {
      style: 'currency',
      currency: 'BRL'
    })
  }
  