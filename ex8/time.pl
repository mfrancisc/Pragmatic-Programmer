#!/usr/bin/perl
#$_ = shift;
#/^(\d\d?)(am|pm)$/ && doTime ($1, 0, $2, 12);
#/^(\d\d?):(\d\d)(am|pm)$/ && doTime($l, $2, $3, 12);
#/^(\d\d?):(\d\d)$/ && doTime($l, $2, 0, 24);
#die "Invalid time $_\n";
##
## doTime(hour, min, ampm, maxHour)
##
#sub doTime($$$$) {
#my ($hour, $min, $offset, $maxHour) = @_;
#
#  print "input var:  @_";
#die "Invalid hour: $hour" if ($hour >= $maxHour);
#$hour += 12 if ($offset eq "pm");
#print $hour*60 + $min, " minutes past midnight\n";
#exit(0);
#}
# accepted formats : 4pm, 7:38pm, 23:42, 3:16, 3:16am

print "Enter time\n";

$time = readline STDIN;
chomp($time); #remove /n from input
if($time =~ /^(\d)(am|pm)$/) {
  validateTimeFormatOne($time);
}

if($time =~ /^(\d\d)(am|pm)$/) {
  validateTimeFormatTwo($time);
}

if($time =~ /^(\d):(\d\d)(am|pm)$/) {
  validateTimeFormatThree($time);
}

if($time =~ /^(\d\d):(\d\d)(am|pm)$/) {
  validateTimeFormatFour($time);
} 

if($time =~ /^(\d):(\d\d)$/) {
  validateTimeFormatFive($time);
} 

if($time =~ /^(\d\d):(\d\d)$/) {
  validateTimeFormatSix($time);
}

die("Invalid time : $time\n");

# 1pm
sub validateTimeFormatOne {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 1); 
  $ampm = getAmPmFromTime($time, $ampmStart = 1);
  $validHour = validateHour($hour, $ampm);
  if($validHour) {
    print "Valid format one : $time\n";
  }else{
    die("Invalid hour : $hour\n"); 
  }
  exit(0);
}

# 10pm
sub validateTimeFormatTwo {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 2); 
  $ampm = getAmPmFromTime($time, $ampmStart = 2);
  $validHour = validateHour($hour, $ampm);
  if($validHour){
    print "Valid format two : $time\n";
  }else{
    die("Invalid hour: $hour\n");
  }
  exit(0);
}

# 1:12pm
sub validateTimeFormatThree {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 1); 
  $ampm = getAmPmFromTime($time, $ampmStart = 4);
  $validHour = validateHour($hour, $ampm);
  if(!$validHour){
    die("Invalid hour: $hour\n");
  }
  $minutes = getMinutesFromTime($time, $minutesStart = 2);
  $validMinutes = validateMinutes($minutes);
  if(!$validMinutes){
    die("Invalid minutes: $minutes\n");
  }

  print "Valid format three : $time\n"; 
  exit(0);
}

# 11:00pm
sub validateTimeFormatFour {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 2); 
  $ampm = getAmPmFromTime($time, $ampmStart = 5);
  $validHour = validateHour($hour, $ampm);
  if(!$validHour){
    die("Invalid hour: $hour\n");
  }
  $minutes = getMinutesFromTime($time, $minutesStart = 3);
  $validMinutes = validateMinutes($minutes);
  if(!$validMinutes){
    die("Invalid minutes: $minutes\n");
  }

  print "Valid format four : $time\n"; 
  exit(0);
}

# 1:00
sub validateTimeFormatFive {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 1); 
  $validHour = validateHour($hour, $ampm = "");
  if(!$validHour){
    die("Invalid hour: $hour\n");
  }
  $minutes = getMinutesFromTime($time, $minutesStart = 2);
  $validMinutes = validateMinutes($minutes);
  if(!$validMinutes){
    die("Invalid minutes: $minutes\n");
  }

  print "Valid format five : $time\n"; 
  exit(0);
}

# 11:00
sub validateTimeFormatSix {
  my ($time) = @_;
  $hour = getHourFromTime($time, $hourLength = 2); 
  $validHour = validateHour($hour, $ampm = "");
  if(!$validHour){
    die("Invalid hour: $hour\n");
  }
  $minutes = getMinutesFromTime($time, $minutesStart = 3);
  $validMinutes = validateMinutes($minutes);
  if(!$validMinutes){
    die("Invalid minutes: $minutes\n");
  }

  print "Valid format six : $time\n"; 
  exit(0);
}

sub getHourFromTime {
  my ($time, $hourLength) = @_;
  return substr $time, 0, $hourLength;
}
sub getHourFromTime {
  my ($time, $hourLength) = @_;
  return substr $time, 0, $hourLength;
}

sub getAmPmFromTime {
  my ($time, $ampmStart) = @_;
  return substr $time, $ampmStart, 2;
}

sub getMinutesFromTime {
  my ($time, $minutesStart) = @_;
  return substr $time, $minutesStart, 2;
}

sub validateHour {
  my ($hour, $ampm) = @_;

  if($ampm eq "") {
    return validateFirstHourFmt($hour); 
  }else{
    return validateSecondHourFmt($hour); 
  }
}

sub validateFirstHourFmt {
  my ($hour) = @_;

  if($hour > 24 || $hour <= 0) {
    return 0;
  }
  return 1;
}

sub validateSecondHourFmt {
  my ($hour) = @_;

  if($hour > 12 || $hour <= 0) {
    return 0;
  }
  return 1;
}

sub validateMinutes {
  my ($minutes) = @_;

  if($minutes > 59) {
    return 0;
  }
  return 1;
}

