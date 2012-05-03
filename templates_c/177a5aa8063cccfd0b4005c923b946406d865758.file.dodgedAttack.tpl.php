<?php /* Smarty version Smarty-3.1.8, created on 2012-05-03 16:34:59
         compiled from "templates/dodgedAttack.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9812991134fa2a5a36d5435-01459809%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '177a5aa8063cccfd0b4005c923b946406d865758' => 
    array (
      0 => 'templates/dodgedAttack.tpl',
      1 => 1336003694,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9812991134fa2a5a36d5435-01459809',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'attacker' => 0,
    'verb' => 0,
    'weaponAdjective' => 0,
    'noun' => 0,
    'appendix' => 0,
    'defender' => 0,
    'dodgeAdjective' => 0,
    'abstractNoun' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa2a5a36efe05_47851068',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa2a5a36efe05_47851068')) {function content_4fa2a5a36efe05_47851068($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['attacker']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['verb']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['weaponAdjective']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['noun']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['appendix']->value;?>
 at <?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
,
but in <?php echo $_smarty_tpl->tpl_vars['dodgeAdjective']->value;?>
 show of <?php echo $_smarty_tpl->tpl_vars['abstractNoun']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
 dodged the attack.
<?php }} ?>