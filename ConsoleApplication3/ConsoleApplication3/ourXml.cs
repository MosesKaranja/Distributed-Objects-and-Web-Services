using System;
using System.IO;
using System.Runtime.Serialization;
using System.Runtime.Serialization.Formatters.Binary;
using System.Xml;

namespace ConsoleApplication3
{
    public class OurXml
    {
        public void ReadDocument()
        {
            XmlTextReader txtReader = new XmlTextReader("books.xml");
            txtReader.Read();
            while (txtReader.Read())
            {
                //move to first element
                txtReader.MoveToElement();
                Console.WriteLine("XmlTextReader Properties Test");
                Console.WriteLine("==============");
                //Lets read this elements properties and display them
                Console.WriteLine("Name: "+txtReader.Name);
                Console.WriteLine("Base URI: "+txtReader.BaseURI);
                Console.WriteLine("Local Name: "+txtReader.LocalName);
                Console.WriteLine("Attribute Count: "+txtReader.AttributeCount.ToString());
                Console.WriteLine("Depth: "+txtReader.Depth.ToString());
                Console.WriteLine("Line Number: "+txtReader.LineNumber.ToString());
                Console.WriteLine("Node Type: "+txtReader.NodeType.ToString());
                Console.WriteLine("Attribute Count: "+txtReader.Value.ToString());

            }
        }


        public void ReadXmlDocument()
        {
            int ws = 0;  
            int pi = 0;  
            int dc = 0;  
            int cc = 0;  
            int ac = 0;  
            int et = 0;  
            int el = 0;  
            int xd = 0; 
            XmlTextReader textReader = new XmlTextReader("books.xml");
            
            while (textReader.Read()) {  
                XmlNodeType nType = textReader.NodeType;  
                // If node type us a declaration  
                if (nType == XmlNodeType.XmlDeclaration) {  
                    Console.WriteLine("Declaration:" + textReader.Name.ToString());  
                    xd = xd + 1;  
                }  
                // if node type is a comment  
                if (nType == XmlNodeType.Comment) {  
                    Console.WriteLine("Comment:" + textReader.Name.ToString());  
                    cc = cc + 1;  
                }  
                // if node type us an attribute  
                if (nType == XmlNodeType.Attribute) {  
                    Console.WriteLine("Attribute:" + textReader.Name.ToString());  
                    ac = ac + 1;  
                }  
                // if node type is an element  
                if (nType == XmlNodeType.Element) {  
                    Console.WriteLine("Element:" + textReader.Name.ToString());  
                    el = el + 1;  
                }  
                // if node type is an entity\  
                if (nType == XmlNodeType.Entity) {  
                    Console.WriteLine("Entity:" + textReader.Name.ToString());  
                    et = et + 1;  
                }  
                // if node type is a Process Instruction  
                if (nType == XmlNodeType.Entity) {  
                    Console.WriteLine("Entity:" + textReader.Name.ToString());  
                    pi = pi + 1;  
                }  
                // if node type a document  
                if (nType == XmlNodeType.DocumentType) {  
                    Console.WriteLine("Document:" + textReader.Name.ToString());  
                    dc = dc + 1;  
                }  
                // if node type is white space  
                if (nType == XmlNodeType.Whitespace) {  
                    Console.WriteLine("WhiteSpace:" + textReader.Name.ToString());  
                    ws = ws + 1;  
                }  
            }
            // Write the summary  
            Console.WriteLine("Total Comments:" + cc.ToString());  
            Console.WriteLine("Total Attributes:" + ac.ToString());  
            Console.WriteLine("Total Elements:" + el.ToString());  
            Console.WriteLine("Total Entity:" + et.ToString());  
            Console.WriteLine("Total Process Instructions:" + pi.ToString());  
            Console.WriteLine("Total Declaration:" + xd.ToString());  
            Console.WriteLine("Total DocumentType:" + dc.ToString());  
            Console.WriteLine("Total WhiteSpaces:" + ws.ToString());  
            
        }

        public void WriteToXmlDoc()
        {
            XmlTextWriter textWriter = new XmlTextWriter("writeXml.xml",null);
            String PI = "type='text/xsl' href='book.xsl'";
            textWriter.WriteProcessingInstruction("xml-stylesheet", PI);
            textWriter.WriteDocType("book", Nothing, Nothing, "<!ENTITY h 'softcover'>");   

        }

        public void createNwriteXML()
        {
            XmlTextWriter textWriter = new XmlTextWriter("created.xml",null);
            //Opens the document
            textWriter.WriteStartDocument();
            //Write comment
            textWriter.WriteComment("First comment XMLTextWriter sample Example");
            textWriter.WriteComment("myXmlFile.xml in root dir");
            //Write first element
            textWriter.WriteStartElement("Student");
            textWriter.WriteStartElement("r","Record","urn:record");
            //Write next element
            textWriter.WriteStartElement("Name","");
            textWriter.WriteString("Student");
            textWriter.WriteEndElement();
            
            //WriteChars
            char[] ch = new char[3];
            ch[0] = 'a';
            ch[1] = 'r';
            ch[2] = 'c';
            textWriter.WriteStartElement("Char");
            textWriter.WriteChars(ch,0,ch.Length);
            textWriter.WriteEndElement();
            
            //End the document
            textWriter.WriteEndElement();
            //Close Writer
            textWriter.Close();

        }

        public void OutputToConsole()
        {
            XmlDocument doc = new XmlDocument();
            //load document with last book node
            XmlTextReader reader = new XmlTextReader("books.xml");
            reader.Read();
            //Load reader
            doc.Load(reader);
            //Display contents on the console
            doc.Save(Console.Out);

        }
        
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

        public string Nothing { get; set; }
    }


}