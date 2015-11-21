%{
#include <stdio.h>
#include "y.tab.h"
%}

%%

[0-9]+                {yylval=atoi(yytext);  return digit;}
"am"                   { return am;}
"pm"                   { return pm;}
[ \t\n]               ;
[:]                    { return colon;}
.                     { printf ("unexpected character");}

%%


