%{
void yyerror (char *s);
int yylex();
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

char ampm_str[15] = "";

typedef int bool;
bool validFormat = 1;
%}

%start input
%token digit
%token am
%token pm
%token colon
%token sep
%token exit_command

%%
input       : /* empty */
            | input line 
            ;

line        : '\n'
            | list '\n' 
            ;

list        : time
            | time sep list 
            | exit_command  {exit(EXIT_SUCCESS);}
            ;


time        :  hour ampm                {if ($1 > 12 || $1 <= 0)  {printf ("Hour out of range\n");validFormat = 0;} else if(validFormat) {printf("Valid time format %d%s\n", $1, ampm_str); } validFormat = 1;}
            |  hour colon minute        {if ($1 > 24 || $1 <= 0)  {printf ("Hour out of range\n");validFormat = 0;} else if(validFormat) {printf("Valid time format   %d:%d\n", $1, $3); } validFormat = 1;}
            |  hour colon minute ampm   {if ($1 > 12 || $1 <= 0)  {printf ("Hour out of range\n");validFormat = 0;} else if(validFormat) {printf ("Valid time format   %d:%d%s\n", $1, $3, ampm_str); } validFormat = 1;}
            ;


hour        :   two_digits        { $$ = $1; }
            |   digit             { $$ = $1; }
            ;

minute      :   two_digits          { $$ = $1; if ($$ > 59) {printf ( "minute out of range\n");validFormat = 0;}}
            |   digit               { $$ = $1; if ($$ > 59) {printf ( "minute out of range\n");validFormat = 0;}}
            ;

two_digits  :  digit digit          {$$ = 0; $$ = $1 * 10 + $2; }
            ;

ampm        :   am               {strcpy(ampm_str, "am");}
            |   pm               {strcpy(ampm_str, "pm");}
            ;


%%
int yywrap()
{
        return 1;
} 

int main (void) {
printf ("Insert time, and press enter\n");
printf ("Type , after each time\n");
printf ("Valid formats : 2am, 12:00, 13:30pm\n");
printf ("exit to quit\n");

  return yyparse();
}


void yyerror (char *s) {fprintf (stderr, "Invalid character: %s\n", s); validFormat = 0;}

