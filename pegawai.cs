using System;

public class Pegawai
{
    protected string nama;
    protected double gaji;

    public Pegawai(string n, double g)
    {
        nama = n;
        gaji = g;
    }

    public string GetNama()
    {
        return nama;
    }

    public virtual double GetGaji()
    {
        return gaji;
    }
}
