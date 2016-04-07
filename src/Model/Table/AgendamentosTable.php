<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;

class AgendamentosTable extends Table
{

    public function initialize(array $config){
        //Define o nomeda tabela do model
        $this->table('DP_AGENDAS');

        //Define o campo utilizado para associações no model
        //$this->displayField('username');

        //Define a chave primária do model
        $this->primaryKey('ID');


        // Definições de relacionamento da tabela
        $this->belongsTo('Convenios', [
            'foreignKey' => 'CONVENIO_ID',
            'bindingKey' => 'ID'
        ]);
        $this->belongsTo('Planos', [
            'foreignKey' => 'PLANO_ID',
            'bindingKey' => 'ID'
        ]);
        $this->belongsTo('Cirurgias', [
            'foreignKey' => 'CD_CIRURGIA',
            'bindingKey' => 'CD_CIRURGIA'
        ]);
        $this->hasMany('Alertas', [
            'foreignKey' => 'CD_PRE_AGENDAMENTO',
            'bindingKey' => 'ID',
            'className' => 'Alertas'
        ]);

    }


    // Função com as validações
    public function validationDefault(Validator $validator){

        //Validações do Nome do Paciente
        $validator->add('NM_PACIENTE',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message'=>'Preencha seu Nome.'],
            'nomeComposto' => [ 'rule' => [$this,'nomeComposto'] , 'message' => 'Preencha Nome e Sobrenome.']
        ]);

        //Validações do Nome do Paciente
        $validator->add('TP_SEXO',
        [
            'notBlank' =>  [ 'rule' => 'notBlank' , 'message' => 'Preencha seu Gênero.'],
            'inList' => [ 'rule' =>  ['inList',['M','F'],false] , 'message' => 'Selecione seu Sexo na lista.']
        ]);

        //Validações do Tipo Sanguíneo
        $validator->add('TP_SANGUINEO',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Preencha seu tipo sanguíneo.'],
            'inList' => [ 'rule' =>  [ 'inList' , ['A','A+','A-','AB','AB+','AB-','B','B+','B-','O','O+','O-'] , false] ,'message' => 'Selecione Seu Tipo Sanguíneo.']
        ]);

        //Validações da Data de nascimento
        $validator->add('DT_NASCIMENTO',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Preencha sua Data de Nascimento.'],
            'data' => [ 'rule' =>  [ 'date' , 'dmy' ] ,'message' => 'Data em formato inválido']
        ]);

        //Validações do Telefone
        $validator->add('FONE',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Preencha seu Telefone.'],
            'tamanho' => [ 'rule' =>  [ 'lengthBetween' , 10, 15] ,'message' => 'Seu Telefone precisa ter entre 10 e 15 números.'],
            'numero' => ['rule'=> 'numeric', 'message' => 'Somente números são aceitos.']
        ]);

        //Validações do Celular
        $validator->add('CELULAR',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Preencha seu Celular.'],
            'tamanho' => [ 'rule' =>  [ 'lengthBetween' , 10, 15] ,'message' => 'Seu Celular precisa ter entre 11 e 15 números.'],
            'numero' => ['rule'=> 'numeric', 'message' => 'Somente números são aceitos.']
        ]);

        //Validações do Convênio
        $validator->add('CONVENIO_ID',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione seu Convênio.']
        ]);

        //Validações do Plano
        $validator->add('PLANO_ID',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione seu Plano.']
        ]);

        //Validações de Especialidades
        $validator->add('ESPECIALIDADE',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione a Especialidade.']
        ]);

        //Validações do SANGUE

        $validator->allowEmpty('HEMACIAS')->add('HEMACIAS',
        [
            'tamanho' => [ 'rule' =>  [ 'range' , 1, 90] ,'message' => 'Preencha um numero de 0 a 10.'],
            'numero' => ['rule'=> 'naturalNumber', 'message' => 'Somente números são aceitos.']
        ]);
        $validator->allowEmpty('PLAQUETAS')->add('PLAQUETAS',
        [
            'tamanho' => [ 'rule' =>  [ 'range' , 1, 90] ,'message' => 'Preencha um numero de 0 a 10.'],
            'numero' => ['rule'=> 'naturalNumber', 'message' => 'Somente números são aceitos.']
        ]);
        $validator->allowEmpty('PLASMA')->add('PLASMA',
        [
            'tamanho' => [ 'rule' =>  [ 'range' , 1, 90] ,'message' => 'Preencha um numero de 0 a 10.'],
            'numero' => ['rule'=> 'naturalNumber', 'message' => 'Somente números são aceitos.']
        ]);
        $validator->allowEmpty('CRIO')->add('CRIO',
        [
            'tamanho' => [ 'rule' =>  [ 'range' , 1, 90] ,'message' => 'Preencha um numero de 0 a 10.'],
            'numero' => ['rule'=> 'naturalNumber', 'message' => 'Somente números são aceitos.']
        ]);

        //Validações de CIRURGIA
        $validator->add('CD_CIRURGIA',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione a Cirurgia Principal.']
        ]);

        //Validações de Especialidades
        $validator->add('ANESTESIA',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione a Especialidade.']
        ]);

        //Validações de Especialidades
        $validator->add('DT_DURACAO',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Selecione o Tempo de Sala Cirúrgica.'],
            'numero' => ['rule'=> 'numeric', 'message' => 'Somente números são aceitos.']
        ]);

        //Validações da Data de nascimento
        $validator->add('DT_CIRURGIA',
        [
            'notBlank' => [ 'rule' => 'notBlank', 'message' => 'Preencha Data pretendida para cirurgia.'],
            'data' => [ 'rule' =>  [ 'datetime' , 'dmy' ] ,'message' => 'Data em formato inválido']
        ]);

        $validator->add('LAUDO',
        [
            'extension' => [ 'rule' => ['extension', ['pdf']] , 'message' => 'Arquivo precisa estar no formato PDF'],
        ]);

        return $validator;
    }

    /**
     *  Prepara/Formata variáveis do request para uso
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function preparaDados(&$d){

        //Arrays para importar txts
        $anestesia = [ '1'=>'Geral', '2'=>'Local', '3'=>'Regional Peridural ou Raquidiana', '4'=>'Sedação'];
        $lateralidade = ['1'=>'Direita', '2'=>'Esquerda', '3'=>'Bilateral', '4'=>'Não se aplica'];

        $d['DT_HOJE'] = Time::now('America/Sao_Paulo'); // new Time('now', 'America/Sao_Paulo');
        $d['DT_CIRURGIA_TXT'] =  $this->fdata($d['DT_CIRURGIA'], '/', true) ;

        $d['DT_DURACAO_TXT'] = $d['DT_HOJE']->format('Y-m-d').' '. $d['DT_DURACAO'] . ':00' ;


        $d['DT_NASCIMENTO'] = new Time( $this->fdata($d['DT_NASCIMENTO'], '/', true) );
        $d['IDADE'] = intval($d['DT_NASCIMENTO']->timeAgoInWords(['accuracy'=>'year', 'end' => '200 years']));
        $d['DT_NASCIMENTO'] = $d['DT_NASCIMENTO']->format('d/m/Y');



        $d['SANGUE'] = ( !empty($d['HEMACIAS']) || !empty($d['PLAQUETAS']) || !empty($d['PLASMA']) || !empty($d['CRIO']) ) ? 'S' : 'N';
        $d['TIPO_UTI_TXT'] = $d['TIPO_UTI']== 'Não' ? 'N' : 'S' ;

        $d['FONE_TXT'] = '('.substr($d['FONE'], 0,2) . ') ' .substr($d['FONE'], 2);
        $d['CELULAR_TXT'] = '('.substr($d['CELULAR'], 0,2) . ') ' .substr($d['CELULAR'], 2);

        $d['ANESTESIA_TXT'] = !empty($d['ANESTESIA']) ? $anestesia[$d['ANESTESIA']] : NULL;
        $d['LATERALIDADE_TXT'] = !empty($d['LATERALIDADE']) ? $lateralidade[$d['LATERALIDADE']] : NULL;

        $d['NM_PACIENTE_TXT'] = ucwords(strtolower($d['NM_PACIENTE']));

        $d['LATEX_TXT'] = $d['LATEX'] == 1 ? 'Alergia a Latex' : NULL ;
        $d['CONGELACAO_TXT'] = $d['CONGELACAO'] == 1  ? 'Necessita Congelação.' : NULL;
        $d['SEM_OPME_TXT'] = $d['SEM_OPME'] == 1  ? 'Não Necessita OPME.' : NULL;
        $d['SEM_LAUDO_TXT'] = $d['SEM_LAUDO'] == 1  ? "Procedimento sem Laudo." : NULL;

        $d['MEDICACAO_TXT'] = !empty($d['MEDICACAO'])  ? 'Medicação Especial: ' . $d['MEDICACAO'] : NULL;

        $d['MEDICAMENTOSA_TXT'] = !empty($d['MEDICAMENTOSA'])  ? 'Alergia Medicamentosa: ' . $d['MEDICAMENTOSA'] : NULL;
        $d['ALIMENTAR_TXT'] = !empty($d['ALIMENTAR'])  ? 'Alergia Alimentar: ' . $d['ALIMENTAR'] : NULL;

        $d['HEMACIAS_TXT'] = !empty($d['HEMACIAS']) ? "Sangue - Concentrado de Hemácias: " . $d['HEMACIAS'].'L'   : NULL;
        $d['PLAQUETAS_TXT'] = !empty($d['PLAQUETAS']) ? "Sangue - Concentrado de Plaquetas: " . $d['PLAQUETAS'].'L' : NULL;
        $d['PLASMA_TXT'] = !empty($d['PLASMA'])  ? "Sangue - Plasma: " . $d['PLASMA'].'L'  : NULL;
        $d['CRIO_TXT'] = !empty($d['CRIO'])  ? "Sangue - Crioprecipitado: " . $d['CRIO'].'L'  : NULL;

        //ADICIONO LISTA DE EQUIPAMENTOS -  Se algum equipamento foi Selecionado Imprimo o título
        $d['EQUIPAMENTOS_TXT'] = '';
        $d['EQUIPAMENTOS_TXT'] .= $d['VIDEO']!== 'Não' ? (empty($a) ? '' : " - ") . "Vídeo Cirúrgico: " . $d['VIDEO'] : '';
        $d['EQUIPAMENTOS_TXT'] .= $d['MICROSCOPIO']!== 'Não' ? (empty($a) ? '' : " - ") . "Microscópio: " . $d['MICROSCOPIO'] : '';
        $d['EQUIPAMENTOS_TXT'] .= $d['CEC']!== 'Não' ? (empty($a) ? '' : " - ") . "CEC: ". $d['CEC'] : '';

        // lista de equipamentos no checkbox
        if( in_array(1, $d['EQUIPAMENTOS']) || !empty($a) ) {
            // Loop nos Valores e gero string
            foreach ($d['EQUIPAMENTOS'] as $key => $value) $d['EQUIPAMENTOS_TXT'] .= $value == 1 ? (empty($a) ? '' : " - ") .str_replace('_', ' ', $key) : '';
            $d['EQUIPAMENTOS_TXT'] =  'Equipamentos: ' . $d['EQUIPAMENTOS_TXT'] ;
        }

        //ADICIONO LISTA DE EQUIPAMENTOS CRÍTICOS -  Se algum equipamento foi Selecionado Imprimo o título
        if(in_array(1, $d['EQUIPAMENTOSC'])) {
            // Loop nos Valores e gero string
            $d['EQUIPAMENTOSC_TXT'] ='';
            foreach ($d['EQUIPAMENTOSC'] as $key => $value) $d['EQUIPAMENTOSC_TXT'] .= $value == 1 ? (empty($a) ? '' : " - ") .str_replace('_', ' ', $key) : '';
            $d['EQUIPAMENTOSC_TXT'] =  'Equipamentos Críticos: ' . $d['EQUIPAMENTOSC_TXT'] ;
        }

        // Chamo função que gera campo de OBSERVACOES
        $this->geraOBS($d);
    }

    /**
     *  Função que gera Observacoes a partir do request
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function geraOBS(&$d){

        $obs = "Doctor+ - Agendado as " . $d['DT_HOJE']->format('d/m/Y H:m') . PHP_EOL;
        $obs .= ucwords(strtolower($d['NM_PACIENTE'])) . " | Data de Nascimento: " . $d['DT_NASCIMENTO'] .PHP_EOL;
        $obs .= "Horário Preferencial: " . $d['DT_DURACAO_TXT'] . PHP_EOL;
        $obs .= "Telefone: " . $d['FONE_TXT'] . PHP_EOL;
        $obs .= "Celular: " . $d['CELULAR_TXT'] . PHP_EOL;
        $obs .= "Matrícula do Convênio: " . $d['CD_MATRICULA'] . PHP_EOL;
        $obs .= "Tipo Sanguíneo: " . $d['TP_SANGUINEO'] . PHP_EOL;

        $obs .= !empty($d['LATEX_TXT']) ? $d['LATEX_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['MEDICAMENTOSA_TXT']) ? $d['MEDICAMENTOSA_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['ALIMENTAR_TXT']) ? $d['ALIMENTAR_TXT'] . PHP_EOL : '';

        $obs .= "Anestesia: " . $d['ANESTESIA_TXT'] . PHP_EOL;
        $obs .= "Lateralidade: " . $d['LATERALIDADE_TXT'] . PHP_EOL;
        $obs .= "Tipo de UTI: " . $d['TIPO_UTI'] . PHP_EOL;
        $obs .= "Diagnóstico: " . $d['DIAGNOSTICO'] . PHP_EOL;
        $obs .= "Comorbidades: " . $d['COMORBIDADES'] . PHP_EOL;

        $obs .= !empty($d['HEMACIAS_TXT']) ? $d['HEMACIAS_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['PLAQUETAS_TXT']) ? $d['PLAQUETAS_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['PLASMA_TXT']) ? $d['PLASMA_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['CRIO_TXT']) ? $d['CRIO_TXT'] . PHP_EOL : '';

        $obs .= !empty($d['CONGELACAO_TXT']) ? $d['CONGELACAO_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['SEM_OPME_TXT']) ? $d['SEM_OPME_TXT'] . PHP_EOL : '';
        $obs .= !empty($d['MEDICACAO_TXT']) ? $d['MEDICACAO_TXT'] . PHP_EOL : '';

        $obs .= !empty($d['EQUIPAMENTOS_TXT']) ? $d['EQUIPAMENTOS_TXT'] : '';
        $obs .= !empty($d['EQUIPAMENTOSC_TXT']) ? $d['EQUIPAMENTOSC_TXT'] : '';

        $obs .= !empty($d['SEM_LAUDO_TXT']) ? $d['SEM_LAUDO_TXT'] . PHP_EOL : '';

        $obs .= !empty($d['OBSERVACOES']) ? "Obs.: " . $d['OBSERVACOES'] . PHP_EOL : '';

        $obs .= "Horas de Sala Cirúrgica: " . $d['DT_DURACAO'] .'h' . PHP_EOL ;
        $obs .= "Dias de Internacao Hospitalar: " . $d['DT_INT_HOSP'] . PHP_EOL ;
        $obs .= "Dias de Internacao UTI: " . $d['DT_INT_UTI'] . PHP_EOL ;

        $d['OBS_FINAL'] = $obs;
        return true;

    }

    /**
     *  Funcao que faz upload dos arquivos
     *  $d = Variável com os dados do POST / usar $this->request->data
     *  $tipo = Nome do campo file que será usado para fazer o Upload
     */
    public function upload(&$d, $tipo = 'LAUDO'){

        // Defino a Pasta onde os uploads vao ser salvos
        $destiny = WWW_ROOT . 'img' . DS . 'temp'  ;
        // Contador de numero de uploads
        $i=1;

        // Se campo estiver vazio/erro no upload retorna falso
        if(empty($d[$tipo])) return false;

        // Dou loop na variavel de Upload
        foreach ($d[$tipo] as $item) {
            // Crio a pasta para o Upload no formato "G" + Código de Internaçao ex:  G01987
            $folder = new Folder( $destiny. DS . 'G' . $d['CD_PRE_INTERNACAO'] , true, 0777);
            // Defino o nome do arquivo a ser salvo. Formato: tipo + # + Contador de upload + nome original minusculo e sem espaços
            $nome = $tipo.'#'.$i.'_'. str_replace( ' ', '_',mb_strtolower($item['name'])) ;
            // Em caso de erro no upload retorna falso
            if($item['error']!=0) return false;
            // Se não copiar arquivo para pasta, retorna falso
            if(!move_uploaded_file($item['tmp_name'], $folder->path . DS . $nome)) return false;
            // Defino a variavel com o novo nome do arquivo
            $item['image'] = $nome;
            // Incremento o contador
            $i++;
        }
        // Caso nao haja erros, funcao retorna verdadeiro
        return true;
    }


    /**
     *  Salva os dados do Agendamento
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function salvaDados(&$d){

        // Pego umas instancia do banco
        $db = ConnectionManager::get('default');

        // Pego o valor da sequence
        $a = $db->query('select dbamv.seq_pre_internacao.nextval@DBLINK_SOULPRD from dual')->fetch('assoc');
        $d['CD_PRE_INTERNACAO'] = $a['NEXTVAL'];

        // Preparo o SQL de Insert
        $insert = $db->prepare("INSERT INTO PRE_INTERNACAO@DBLINK_SOULPRD
        ( CD_PRESTADOR, CD_PRE_INTERNACAO, DT_PEDIDO, NM_PACIENTE, NR_FONE_MOVEL_PACIENTE, NR_FONE_FIXO_PACIENTE, NR_FONE_COMERCIAL_PACIENTE, DT_CIRURGIA, DT_TEMPO_PREVISTO, SN_SANGUE_PARA_PACIENTE, DS_GRUPO_SANGUINEO, SN_CTI_APOS_CIRURGIA, CD_ANESTESISTA, CD_AUXILIAR_UM , CD_AUXILIAR_DOIS, CD_AUXILIAR_TRES , CD_INSTRUMENTADOR, CD_PEDIATRA, CD_TIP_ANEST, CD_CON_PLA, CD_CONVENIO, STATUS, DS_EMAIL_PACIENTE, DS_OBS, IDADE_PACIENTE, TP_IDADE, TP_SEXO, CD_AVISO_INTERNACAO, TP_INTERNACAO, DT_SUGESTAO_CIRURGIA , CD_PACIENTE, SN_CONGELACAO, CD_ESPECIALID, NM_USUARIO_PRE_INTERNACAO, NM_USUARIO_LIBERA_ANESTESIA, DT_LIBERA_ANESTESIA, NM_USUARIO_CANCELA_AGENDA, DT_CANCELA_AGENDA, DS_CANCELAMENTO, CD_PRE_INTERNACAO_INTEGRA, CD_SEQ_INTEGRA, DT_INTEGRA )
        VALUES (:cd_prestador, :cd_pre_internacao, :dt_pedido, :nm_paciente, :nr_fone_movel_paciente, :nr_fone_fixo_paciente, :nr_fone_comercial_paciente, :dt_cirurgia, :dt_tempo_previsto, :sn_sangue_para_paciente, :ds_grupo_sanguineo, :sn_cti_apos_cirurgia, :cd_anestesista, :cd_auxiliar_um , :cd_auxiliar_dois, :cd_auxiliar_tres , :cd_instrumentador, :cd_pediatra, :cd_tip_anest, :cd_con_pla, :cd_convenio, :status, :ds_email_paciente, :ds_obs, :idade_paciente, :tp_idade, :tp_sexo, :cd_aviso_internacao, :tp_internacao, :dt_sugestao_cirurgia, :cd_paciente, :sn_congelacao, :cd_especialid, :nm_usuario_pre_internacao, :nm_usuario_libera_anestesia, :dt_libera_anestesia, :nm_usuario_cancela_agenda, :dt_cancela_agenda, :ds_cancelamento, :cd_pre_internacao_integra, :cd_seq_integra, :dt_integra )
        ");

        // Dou bind nas variaveis
        $insert->bindValue('cd_prestador', 					$d['CD_PRESTADOR'] , 'integer');
        $insert->bindValue('cd_pre_internacao', 			$d['CD_PRE_INTERNACAO'] , 'integer');
        $insert->bindValue('dt_pedido', 					$d['DT_HOJE'] , 'date');
        $insert->bindValue('nm_paciente', 					$d['NM_PACIENTE_TXT'] , 'string');
        $insert->bindValue('nr_fone_movel_paciente', 		$d['CELULAR_TXT'] , 'string');

        $insert->bindValue('nr_fone_fixo_paciente', 		$d['FONE_TXT'] , 'string');
        $insert->bindValue('nr_fone_comercial_paciente',	NULL , 'string');
        $insert->bindValue('dt_cirurgia', 					NULL , 'date');
        $insert->bindValue('dt_tempo_previsto', 			$d['DT_DURACAO_TXT'] , 'date');
        $insert->bindValue('sn_sangue_para_paciente', 		$d['SANGUE'] , 'string');

        $insert->bindValue('ds_grupo_sanguineo', 			$d['TP_SANGUINEO'] , 'string');
        $insert->bindValue('sn_cti_apos_cirurgia',			$d['TIPO_UTI_TXT'] , 'string');
        $insert->bindValue('cd_anestesista', 				NULL , 'integer');
        $insert->bindValue('cd_auxiliar_um', 				NULL , 'integer');
        $insert->bindValue('cd_auxiliar_dois', 				NULL , 'integer');

        $insert->bindValue('cd_auxiliar_tres', 				NULL , 'integer');
        $insert->bindValue('cd_instrumentador',				NULL , 'integer');
        $insert->bindValue('cd_pediatra', 					NULL , 'integer');
        $insert->bindValue('cd_tip_anest', 					$d['ANESTESIA'] , 'integer');
        $insert->bindValue('cd_con_pla', 					$d['PLANO_ID'] , 'integer');

        $insert->bindValue('cd_convenio', 					$d['CONVENIO_ID'] , 'integer');
        $insert->bindValue('status',						'S' , 'string');
        $insert->bindValue('ds_email_paciente',				$d['EMAIL'] , 'string');
        $insert->bindValue('ds_obs', 						$d['OBS_FINAL'] , 'string');
        $insert->bindValue('idade_paciente', 				$d['IDADE'] , 'string');

        $insert->bindValue('tp_idade', 						'A' , 'string');
        $insert->bindValue('tp_sexo',						$d['TP_SEXO'] , 'string');
        $insert->bindValue('cd_aviso_internacao',			NULL , 'integer');
        $insert->bindValue('tp_internacao', 				'C' , 'string');
        $insert->bindValue('dt_sugestao_cirurgia',			$d['DT_CIRURGIA_TXT'] , 'string');

        $insert->bindValue('cd_paciente', 					NULL , 'integer');
        $insert->bindValue('sn_congelacao',					$d['CONGELACAO'] , 'string');
        $insert->bindValue('cd_especialid',					$d['ESPECIALIDADE'] , 'integer');
        $insert->bindValue('nm_usuario_pre_internacao', 	$d['USUARIO'] , 'string');
        $insert->bindValue('nm_usuario_libera_anestesia',	$d['USUARIO'] , 'string');

        $insert->bindValue('dt_libera_anestesia', 	 	    NULL , 'date');
        $insert->bindValue('nm_usuario_cancela_agenda',	    NULL , 'string');
        $insert->bindValue('dt_cancela_agenda',             NULL , 'date');
        $insert->bindValue('ds_cancelamento',               NULL , 'string');
        $insert->bindValue('cd_pre_internacao_integra',     NULL , 'integer');

        $insert->bindValue('cd_seq_integra', 			    NULL , 'integer');
        $insert->bindValue('dt_integra',	                NULL , 'date');

        // Caso de erro no intset, funcao retorna falso
        if (!$insert->execute())  return 'Erro ao cadastrar Agendamento';
        // Executo funcao que cadastra cirurgias
        $this->addCirurgia($d);
        // Executo funcao que cadastra OPME
        $this->addOPME($d);
        // Executo funcao que Salva alerta
        $this->addAlerta($d);
        // Funcao retorna verdadeiro
        return true ;

    }

    /**
     *  Funcao que adidiona cirurgias
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function addCirurgia(&$d){

        // Pego umas instancia do banco
        $db = ConnectionManager::get('default');

        // Caso código nao esteja vazio
        if(!empty($d['CD_CIRURGIA'])) {

            //Carrego o código da sequence
            $a = $db->query('SELECT  SEQ_PRE_INT_CIRURGIA.NEXTVAL@DBLINK_SOULPRD FROM DUAL')->fetch('assoc');
            $cd_pre_int_cirurgia = $a['NEXTVAL'];

            //Gero a query do insert da cirurgia
            $insert = $db->prepare("INSERT INTO PRE_INTERNACAO_CIRURGIA@DBLINK_SOULPRD
                (CD_CIRURGIA, CD_PRE_INTERNACAO, SN_PRINCIPAL, CD_PRE_INT_CIRURGIA, CD_PRE_INT_CIRURGIA_INTEGRA, CD_SEQ_INTEGRA, DT_INTEGRA)
                VALUES ( :cd_cirurgia , :cd_pre_internacao ,'S', :cd_pre_int_cirurgia ,null,null,null)
            ");

            // Dou Bind nos valores
            $insert->bindValue('cd_cirurgia',           $d['CD_CIRURGIA'] , 'integer');
            $insert->bindValue('cd_pre_internacao',     $d['CD_PRE_INTERNACAO'] , 'integer');
            $insert->bindValue('cd_pre_int_cirurgia',   $cd_pre_int_cirurgia , 'integer');

            // Executo a query , em caso de erro a função retorna o erro em String
            if (!$insert->execute()) return 'Erro ao cadastrar Cirurgia Principal.';

            //Gero a query do insert do prestador
            $insert = $db->prepare("INSERT INTO PRE_INTERNACAO_PRESTADOR@DBLINK_SOULPRD (CD_PRE_INTERNACAO , CD_PRE_INT_CIRURGIA, CD_PRESTADOR, CD_ATI_MED)
                VALUES  ( :cd_pre_internacao , :cd_pre_int_cirurgia, :prestador,'01')
            ");

            // Dou Bind nos valores
            $insert->bindValue('cd_pre_internacao',     $d['CD_PRE_INTERNACAO'] , 'integer');
            $insert->bindValue('cd_pre_int_cirurgia',   $cd_pre_int_cirurgia , 'integer');
            $insert->bindValue('prestador',             $d['CD_PRESTADOR'] , 'integer');

            // Executo a query , em caso de erro a função retorna o erro em String
            if (!$insert->execute()) return 'Erro ao cadastrar Prestador Cirurgia Principal.';

        } else {
            // Caso de vazio retorno falso/mensagem, de erro
            return 'Cirurgia Principal não selecionada.';
        }

        // Caso código nao esteja vazio
        if(!empty($d['CD_CIRURGIA_EXTRA'])) {

            // Loop no Array de cirurgias adidionais
            foreach ($d['CD_CIRURGIA_EXTRA'] as $value) {

                //Carrego o código da sequence
                $a = $db->query('SELECT  SEQ_PRE_INT_CIRURGIA.NEXTVAL@DBLINK_SOULPRD FROM DUAL')->fetch('assoc');
                $cd_pre_int_cirurgia = $a['NEXTVAL'];

                //Gero a query do insert da cirurgia
                $insert = $db->prepare("INSERT INTO PRE_INTERNACAO_CIRURGIA@DBLINK_SOULPRD
                    (CD_CIRURGIA, CD_PRE_INTERNACAO, SN_PRINCIPAL, CD_PRE_INT_CIRURGIA, CD_PRE_INT_CIRURGIA_INTEGRA, CD_SEQ_INTEGRA, DT_INTEGRA)
                    VALUES ( :cd_cirurgia , :cd_pre_internacao ,'N', :cd_pre_int_cirurgia ,null,null,null)
                ");

                // Dou Bind nos valores
                $insert->bindValue('cd_cirurgia',           $value , 'integer');
                $insert->bindValue('cd_pre_internacao',     $d['CD_PRE_INTERNACAO'] , 'integer');
                $insert->bindValue('cd_pre_int_cirurgia',   $cd_pre_int_cirurgia , 'integer');

                // Executo a query , em caso de erro a função retorna o erro em String
                if (!$insert->execute()) return 'Erro ao cadastrar Cirurgia Principal.';

                //Gero a query do insert do prestador
                $insert = $db->prepare("INSERT INTO PRE_INTERNACAO_PRESTADOR@DBLINK_SOULPRD (CD_PRE_INTERNACAO , CD_PRE_INT_CIRURGIA, CD_PRESTADOR, CD_ATI_MED)
                    VALUES  ( :cd_pre_internacao , :cd_pre_int_cirurgia, :prestador,'01')
                ");

                // Dou Bind nos valores
                $insert->bindValue('cd_pre_internacao',     $d['CD_PRE_INTERNACAO'] , 'integer');
                $insert->bindValue('cd_pre_int_cirurgia',   $cd_pre_int_cirurgia , 'integer');
                $insert->bindValue('prestador',             $d['CD_PRESTADOR'] , 'integer');

                // Executo a query , em caso de erro a função retorna o erro em String
                if (!$insert->execute()) return 'Erro ao cadastrar Cirurgia Principal.';
            }
        }
        // Funcao executou tudo, retorna verdadeiro
        return true;
    }

    /**
     *  Funcao que adidiona OPME ao agedamento
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function addOPME(&$d){
        // Pego instancia do DB
        $db = ConnectionManager::get('default');

        // Preparo a query de insert
        $insert = $db->prepare("INSERT INTO it_material_pre_internacao@DBLINK_SOULPRD
            (CD_PRODUTO , CD_PRE_INTERNACAO, NR_QUANTIDADE, DS_PRODUTO , CD_FORNECEDOR , CD_UNI_PRO , CD_IT_MAT_PRE_INTERN_INTEGRA, CD_SEQ_INTEGRA , DT_INTEGRA , CD_IT_MATERIAL_PRE_INTERNACAO)
            VALUES (:cod, :cd_pre_internacao, 1, :opme, null, null, null, null, null, :cd_pre_internacao)
        ");

        // Dou bind nos valores
        $insert->bindValue('cd_pre_internacao', $d['CD_PRE_INTERNACAO'] , 'integer');
        $insert->bindValue('opme',              $d['SEM_OPME']==1 ? 'SEM OPME' : 'OPME' , 'string');
        $insert->bindValue('cod',               $d['SEM_OPME']==1 ? 3750 : 3749        , 'integer');

        // Executo a query , em caso de erro a função retorna o erro em String
        if(!$insert->execute()) return false;

        //Senao funcaio retorna verdadeiro
        return true;

    }

    /**
     *  Funcao que adidiona Alerta ao agendamento
     *  $d = Variável com os dados do POST / usar $this->request->data
     */
    public function addAlerta(&$d) {

        // Pego umas instancia do banco
        $db = ConnectionManager::get('default');

        //Carrego o código da sequence
        $a = $db->query('SELECT  SEQ_DOCTOR_MENSAGEM.NEXTVAL FROM DUAL')->fetch('assoc');
        $CD_MENSAGEM = $a['NEXTVAL'];

        //Preparo a Consulta
        $insert = $db->prepare("insert into DP_ALERTAS
        (CD_MENSAGEM, CD_PRE_AGENDAMENTO, CD_PRESTADOR, STATUS, SN_LIDO, DT_MENSAGEM) values
        (:cd_mensagem, :cd_pre_internacao, :cd_prestador, 'S' , 'N' , :data)");

        //Bind nos values
        $insert->bindValue('cd_mensagem',       $CD_MENSAGEM , 'integer');
        $insert->bindValue('cd_pre_internacao', $d['CD_PRE_INTERNACAO'] , 'integer');
        $insert->bindValue('cd_prestador',      $d['CD_PRESTADOR'], 'string');
        $insert->bindValue(':data',             $d['DT_HOJE'], 'datetime');

        // Executo a query , em caso de erro a função retorna o erro em String
        if(!$insert->execute()) return false;
        return true;

    }

    /**
     *  Funcao que trata os erros na Entity
     *  $d =  passar $entity->errors()
     */
    public function trataErros($d) {
        $erros='';
        // Loop no array e gero Lista com erros
        foreach ($d as $key => $field) {
            //$erros .= empty($erros) ? '<p>Os seguintes erros foram encontrados:</p>' : '';
            $erros .= '<ul>';
            foreach ($field as $value) {
                $erros .= '<li>'.$key.' // '.$value. "<br></li>" ;
            }
            $erros .= '</ul>';
        }
        return $erros;
    }

    /* Funçao que agregas informações sobre status de Agendamentos. quantidades, cor usada e ícone */
    public function contaStatus() {
        /* Crio conexão e faco uma consulta que busca os totais de cata STATUS_CHR*/
        $db = ConnectionManager::get('default');
        $result = $db->execute("SELECT Count(STATUS_CHR) AS COUNT, STATUS_CHR  FROM DP_AGENDAS GROUP BY STATUS_CHR ORDER BY STATUS_CHR asc")->fetchAll('assoc');

        /* Crio variavel que receberá os dados tratados e adiciono as informações de ícone e de cor*/
        $d =
            [
                'S'=> ['icon'=>'fa-calendar-o',         'cor'=> 'default'   ,'count'=>0],
                'A'=> ['icon'=>'fa-calendar-plus-o',    'cor'=> 'info'      ,'count'=>0],
                'P'=> ['icon'=>'fa-calendar-minus-o',   'cor'=> 'warning'   ,'count'=>0],
                'N'=> ['icon'=>'fa-calendar-times-o',   'cor'=> 'danger'    ,'count'=>0],
                'C'=> ['icon'=>'fa-calendar-check-o',   'cor'=> 'success'   ,'count'=>0],
                'R'=> ['icon'=>'fa-calendar-check-o',   'cor'=> 'extra'     ,'count'=>0],
            ];

        /*Dou um loop no array, trato o resultado e jogo na variavel 'count' correspondente ao array da letra : Ex.: $array =  ['A' => [ 'icone'=>'icone', 'cor' => 'text-info', count='0'] ]*/
        foreach ($result as $value) {
            $d[$value['STATUS_CHR']]['count'] = $value['COUNT']>0 ? $value['COUNT'] : 0;
        }
        return $d;
    }

    /* Função alterna formato da data se usado fdata('08/01/1983') retorna 1983-08-01 se usa fdata('1983-08-01') retorna 08/01/1983  use time = true se for utilizar datas com horario */
    public function fdata( $data, $sep = '/', $time = false ){

        if($time) {
            $hora = substr($data,10);
            $data = substr($data,0,10);
        }
        if(strripos($data,'/')) {
            $data = explode('/',$data);
            $data = array_reverse($data);
            $data = implode('-',$data);
        } else if(strripos($data,'-')){
            $data = explode('-',$data);
            $data = array_reverse($data);
            $data = implode('/',$data);
        }
        if($time) $data .= $hora;

        return $data;
    }

    // Funcoes de Validação

    //Valida se nome digitado possui nome e sobreno e se os nomes possuem mais de dois caracteres
    public function nomeComposto($check){
        $check = explode(' ',trim($check));
        // if(count($check)>1) {
        //     return true;
        // } else {
        //     return false;
        // }

        //Valida se nome e sobrenome foram informados e se eles temmais de 3 caracteres
        if(count($check)>1){
            $i=0;
            foreach ($check as $value) {
                $i++;
                if($i>2 ) break;
                if(mb_strlen($value)<3) return false;
            }
        } else {
            return false;
        }
        return true;
    }

}
