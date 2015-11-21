%{
void yyerror (char *s);
int yylex();
#include <stdio.h>
#include <string.h>
 
#define YYSTYPE char *

%}

%start time
%token digit
%token am
%token pm
%token colon

%%

time        :  hour ampm           {printf ("Valid time format 1 : %d%s\n ", $1, $2);}
            |  hour colon minute   {printf ("Valid time format 2 : %d:%d\n",$1, $3);}
            |  hour colon minute ampm {printf ("Valid time format 3 : %d:%d%s\n",$1, $3, $4); }
            ;

ampm        :   am               {$$ = "am";}
            |   pm               {$$ = "pm";}
            ;

hour        :   digit digit             {$$ = $1;}
            |   digit          { $$ = $1 ;}
            ;

minute      :   digit digit         {$$ =  $1 ;} 
            ;

%%
int yywrap()
{
        return 1;
} 

int main (void) {
while( yylex() )
		;
	return 0;
  return yyparse();
}

void yyerror (char *s) {fprintf (stderr, "%s\n", s);}

