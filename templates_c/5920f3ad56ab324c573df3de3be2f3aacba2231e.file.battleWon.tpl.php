<?php /* Smarty version Smarty-3.1.8, created on 2012-05-03 16:34:59
         compiled from "templates/battleWon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19412514474fa2a5a36f45d5-30839684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5920f3ad56ab324c573df3de3be2f3aacba2231e' => 
    array (
      0 => 'templates/battleWon.tpl',
      1 => 1336003833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19412514474fa2a5a36f45d5-30839684',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'winner' => 0,
    'health' => 0,
    'loser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa2a5a36fe3f1_62592167',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa2a5a36fe3f1_62592167')) {function content_4fa2a5a36fe3f1_62592167($_smarty_tpl) {?>The battle is over.
<?php echo $_smarty_tpl->tpl_vars['winner']->value;?>
 has won (with <?php echo $_smarty_tpl->tpl_vars['health']->value;?>
 health left).
<?php echo $_smarty_tpl->tpl_vars['loser']->value;?>
 is dead. Shame.
<?php }} ?>