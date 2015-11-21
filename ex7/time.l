%{
#include <stdio.h>
#include "y.tab.h"
%}

%%

[0-9]+                {yylval=atoi(yytext); return digit;}
"am"                   {yylval=yytext; return am;}
"pm"                   {yylval=yytext; return pm;}
[ \t\n]               ;
[:]                    {yylval =yytext; return colon;}
.                     { printf ("Invalid character\n");}

%%


