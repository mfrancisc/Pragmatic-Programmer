public class refactor1 {

  public void calcTexasRate(int rate)
  {
      amt = base * rate;
      calc = 2*basis(amt) + extra(amt)*1.05;
  }

  public void main () {
    switch (state) {
      case TEXAS : calcTexasRate(TX_RATE);
        break; 

      case OHIO : calcOhioRate(OH_RATE);
                  points = 2;
        break; 

      case MAINE : calcOhioRate(MN_RATE);
        break; 
    
    
    }
  }
}
