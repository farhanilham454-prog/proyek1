using System;

public class Manajer : Pegawai
{
    private double tunjangan;
    private double bonus;

    public Manajer(string n, double g) : base(n, g)
    {
        tunjangan = 0;
        bonus = 0;
    }

    public void SetTunjangan(double t)
    {
        tunjangan = t;
    }

    public void SetBonus(double b)
    {
        bonus = b;
    }

    public override double GetGaji()
    {
        return gaji + tunjangan + bonus;
    }
}
