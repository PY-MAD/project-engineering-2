//////////////////////////////////////////////////////////////////////////////
//
// SAMA SARIE SYSTEM
//      
// Module: saudi_iban.js
//
// Synopsis:
// This is a simplified, Saudi-specific version of the generic IBAN
// checking script published by UN/CEFACT on www.tbg5-finance.org
//
// Author:        S Ainsworth
//
// Created:       13-Jan-2008
//
// Revision History:
//
// 0.1   13-Jan-2008   First version
//
//////////////////////////////////////////////////////////////////////////////

// Arrays for converting letters to digits
var letter = new Array (
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M",
    "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
var digits = new Array (
    "10","11","12","13","14","15","16","17","18","19","20","21","22",
    "23","24","25","26","27","28","29","30","31","32","33","34","35");

// Saudi-specific IBAN parameters
var sa_ilen = 24;                       // IBAN length
var sa_ctry = "SA";                     // Country code
var sa_bban = /\d{2}[A-Za-z0-9]{18}/;   // BBAN structure

// Validate a Saudi IBAN
function validate_saudi_iban(iban)
{
    // IBAN must consist entirely of characters a-z, A-Z, 0-9
    pattern = /\W|_/;
    if (pattern.test(iban))
    {
        alert("IBAN contains illegal characters");
        return -1;
    }

    // First four characters must be letter-letter-digit-digit
    pattern = /^\D\D\d\d.+/;
    if (pattern.test(iban) == false)
    {
        alert("Invalid IBAN structure"); 
        return -2; 
    }

    // Check digits cannot be 00, 01 or 99
    pattern = /^\D\D00.+|^\D\D01.+|^\D\D99.+/;
    if (pattern.test(iban))
    {
        alert("Invalid IBAN check digits");
        return -3; 
    }

    // Validate country code
    ctry = iban.substr(0, 2);
    if (ctry != sa_ctry) 
    {
        alert("Invalid country code - Saudi IBANs must begin with '" + sa_ctry + "'"); 
        return -4; 
    }

    // Validate length
    if ((iban.length - sa_ilen) != 0)
    {
        alert("Invalid length - Saudi IBANs must be " + sa_ilen + " characters long");
        return -5;
    }

    // Validate BBAN structure
    pattern = sa_bban;
    if (pattern.test(iban.substr(4, sa_ilen - 4)) == false)
    {
        alert("Invalid IBAN structure");
        return -6;
    }

    // Convert to upper case
    iban = iban.toUpperCase();

    // Move country and check digits to the end
    iban = iban.substr(4, sa_ilen - 4) + iban.substr(0, 4);

    // Replace letters with digits
    for (i = 0; i <= 25; i++)
    {
        while (iban.search(letter[i])!= -1)
        {
            iban = iban.replace(letter[i], digits[i]);
        }
    }

    // Calculate modulo 97 remainder
    coss = Math.ceil(iban.length / 7);
    rmndr = "";
    for (i = 1; i <= coss; i++)
    {
        rmndr = String(parseFloat(rmndr + iban.substr((i - 1) * 7, 7)) % 97);
    }

    // Remainder must be 1
    if (rmndr != "1")
    {
        alert("Incorrect IBAN check digits");
        return -7;
    } 

    // IBAN is valid
    alert("The IBAN seems to be valid");
    return 0;
}

validate_saudi_iban("SA0215000900140986560008")