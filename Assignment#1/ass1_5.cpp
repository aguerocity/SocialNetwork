import java.util.*;
import java.lang.*;
import java.io.*;
import java.math.*;

class FacorialOfBigNuumber
{
        public static void main (String[] args) throws java.lang.Exception
        {
                 BigInteger fact= BigInteger.ONE;
                 int factorialNo = 100;

            for (int i = 2; i <= factorialNo; i++)
               {
                    fact = fact.multiply(new BigInteger(String.valueOf(i)));
               }

             System.out.println("The factorial of " + factorialNo +" is: " + fact);
         }
}