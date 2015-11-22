%{
#include <stdio.h>
#include "y.tab.h"
void yyerror (char *s);
%}

%%

[0-9]+                {yylval=atoi(yytext); return digit;}
"am"                   { return am;}
"pm"                   { return pm;}
"exit"                 { return exit_command;}
[:]                    { return colon;}
[,]                    { return sep; }
[ \t\n]               ;
.                     { yyerror (yytext);}

%%


