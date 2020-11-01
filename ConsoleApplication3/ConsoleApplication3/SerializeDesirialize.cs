using System;
using System.IO;
using System.Runtime.Serialization;
using System.Runtime.Serialization.Formatters.Binary;

namespace ConsoleApplication3
{
    public class SerializeDesirialize
    {
        public int ID;
        public String name;

        public void SerializeDesrialize()
        {
            SerializeDesirialize sd = new SerializeDesirialize();
            sd.ID = 1;
            sd.name = "Moshe";
            
            IFormatter formatter = new BinaryFormatter();
            Stream stream = new FileStream("ExampleCreated.txt", FileMode.Create,FileAccess.Write);
            
            formatter.Serialize(stream, sd);
            stream.Close();
            
            stream = new FileStream("ExampleCreated.txt",FileMode.Open,FileAccess.Read);
            SerializeDesirialize sdNew = (SerializeDesirialize) formatter.Deserialize(stream);
            
            Console.WriteLine(sdNew.ID);
            Console.WriteLine(sdNew.name);

            Console.ReadKey();


        }
        
        
    }
    
}