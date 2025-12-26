using System;

public class Staff : Pegawai
{
    private double lembur;

    public Staff(string n, double g) : base(n, g)
    {
        lembur = 0;
    }

    public void SetLembur(double l)
    {
        lembur = l;
    }

    public override double GetGaji()
    {
        return gaji + lembur;
    }
}
