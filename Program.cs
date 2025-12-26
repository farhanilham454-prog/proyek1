using System;

class Program
{
    static void Main(string[] args)
    {
        Pegawai p1 = new Pegawai("si bujang", 3500000);
        Console.WriteLine("Pegawai: " + p1.GetNama());
        Console.WriteLine("Gaji: " + p1.GetGaji());

        Staff s1 = new Staff("enam", 4000000);
        s1.SetLembur(500000);

        Console.WriteLine("\nStaff: " + s1.GetNama());
        Console.WriteLine("Gaji Total: " + s1.GetGaji());

        Manajer m1 = new Manajer("ilham", 8000000);
        m1.SetTunjangan(1000000);
        m1.SetBonus(2000000);

        Console.WriteLine("\nManajer: " + m1.GetNama());
        Console.WriteLine("Gaji Total: " + m1.GetGaji());

        Console.ReadLine();
    }
}
