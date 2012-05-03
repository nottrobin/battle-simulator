<?php /* Smarty version Smarty-3.1.8, created on 2012-05-03 16:34:59
         compiled from "templates/specialSkill.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8335857894fa2a5a36ac313-63412270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc8e3019ae9597b1bfb0bcc9c20402af917182ef' => 
    array (
      0 => 'templates/specialSkill.tpl',
      1 => 1336052629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8335857894fa2a5a36ac313-63412270',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'luckyStrike' => 0,
    'attacker' => 0,
    'stunningBlow' => 0,
    'defender' => 0,
    'counterAttack' => 0,
    'damage' => 0,
    'health' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa2a5a36d2533_36900118',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa2a5a36d2533_36900118')) {function content_4fa2a5a36d2533_36900118($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['luckyStrike']->value){?>A Lucky Strike! <?php echo $_smarty_tpl->tpl_vars['attacker']->value;?>
 dealt double damage!
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['stunningBlow']->value){?>Stunning Blow! <?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
 is now stunned!
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['counterAttack']->value){?>Counter Attack!
<?php echo $_smarty_tpl->tpl_vars['defender']->value;?>
 dealt <?php echo $_smarty_tpl->tpl_vars['damage']->value;?>
 damage to <?php echo $_smarty_tpl->tpl_vars['attacker']->value;?>
.
<?php echo $_smarty_tpl->tpl_vars['attacker']->value;?>
 now has <?php echo $_smarty_tpl->tpl_vars['health']->value;?>
 health.
<?php }?>

<?php }} ?>