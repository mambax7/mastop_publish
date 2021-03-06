<?php namespace XoopsModules\Mastoppublish;

### =============================================================
### Mastop InfoDigital - Paixão por Internet
### =============================================================
### Classe para manipulação de Arquivos
### =============================================================
### Developer: Fernando Santos (topet05), fernando@mastop.com.br
### Copyright: Mastop InfoDigital © 2003-2006
### -------------------------------------------------------------
### www.mastop.com.br
### =============================================================
###
### =============================================================


class Media extends Mastop
{
    public function __construct($id = null)
    {
        $this->db     = \XoopsDatabaseFactory::getDatabaseConnection();
        $this->tabela = $this->db->prefix(MPU_MOD_TABELA3);
        $this->id     = 'med_10_id';
        $this->initVar('med_10_id', XOBJ_DTYPE_INT);
        $this->initVar('med_30_nome', XOBJ_DTYPE_TXTBOX);
        $this->initVar('med_30_arquivo', XOBJ_DTYPE_TXTBOX);
        $this->initVar('med_10_altura', XOBJ_DTYPE_INT, 0);
        $this->initVar('med_10_largura', XOBJ_DTYPE_INT, 0);
        $this->initVar('med_10_tamanho', XOBJ_DTYPE_INT, 0);
        $this->initVar('med_10_tipo', XOBJ_DTYPE_INT, 1);
        $this->initVar('med_12_exibir', XOBJ_DTYPE_INT, 1);
        $this->initVar('med_22_data', XOBJ_DTYPE_INT, 0);
        if (!empty($id)) {
            if (is_array($id)) {
                $this->assignVars($id);
            } else {
                $this->load((int)$id);
            }
        }
    }

    public function deletaArquivo()
    {
        if (file_exists(MPU_MEDIA_PATH . '/' . $this->getVar('med_30_arquivo'))) {
            @unlink(MPU_MEDIA_PATH . '/' . $this->getVar('med_30_arquivo'));

            return true;
        }

        return false;
    }
}
